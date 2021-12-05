class App {
    constructor() {
        this.basket = {}; 
        this.dropZone = []; //장바구니 
        this.iList = [];
        this.iListMap = {};
        this.cart = document.querySelector(".cart-table");
        this.basketZone = document.querySelector(".cart-list");
        this.dropZone = document.querySelector(".drop-zone"); 
        this.container = document.querySelector(".list-container");
        this.popup = document.querySelector("#popup");
        this.totalSum = document.querySelector("#sum-Pr");
        
        fetch("./resources/store/store.json")
        .then(res => res.json())
        .then(data => this.init(data));
        // .then(data => console.log(data));
        
        this.cho = ["ㄱ", "ㄲ", "ㄴ", "ㄷ", "ㄸ", "ㄹ", "ㅁ", "ㅂ", "ㅃ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅉ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"];
    }

    init(data) {
        this.iList = data;
        this.iList.forEach(x => {
            x.priceNum = parseInt(x.price.replace(/,/g, ''));
            x.cho_product_name = this.getChosung(x.product_name)
            x.cho_brand = this.getChosung(x.brand); 
        }); 
        this.iListMap = data.reduce( (r, x) => ({...r, [x.id]: x}), {});

        this.container.innerHTML = ""; 
        this.iList.forEach(item => this.makeTemplate(item));

        this.dropZone.addEventListener("drop", this.dropHandle);
        this.dropZone.addEventListener("dragover", this.moveDrop);

        document.querySelector("#open-buy").addEventListener("click", ()=>{
            this.popup.style.display = "flex";
        });
        document.querySelector("#buyCancel").addEventListener("click", ()=>{
            this.popup.style.display = "none";
        });
        document.querySelector("#buyConfirm").addEventListener("click", this.buyConfirm);
        
        document.querySelector("#closeResult").addEventListener("click", ()=>{
            document.querySelector("#result").style.display = "none";
        });
        document.querySelector("#search-btn").addEventListener("click", this.search);
        document.querySelector("#keyword").addEventListener("keyup", this.search);
    }

    getChosung(str){
        let result = "";
        for(let i = 0; i < str.length; i++){
            let tmp = str[i].charCodeAt() - 0xAC00;
            let jong = tmp % 28; //종성
            let jung =  (( tmp - jong) / 28)  % 21; //중성
            let cho = ( ( ( tmp - jong ) / 28) - jung ) / 21; //초성
            result += this.cho[cho];
        }
        return result;
    }

    dropHandle = e => {  
        console.log("!");
        e.preventDefault();
        let idx = e.dataTransfer.getData("idx");
        console.log(idx);
        console.log(e.dataTransfer);
        console.log("!");
        if(idx != "") {
            this.appendBasket(idx);
        }

    }

    moveDrop = e => {
        e.preventDefault();
    }

    appendBasket(idx) {
        if(this.basket[idx] != undefined && this.basket[idx] != 0) {
            alert("이미 장바구니에 담긴 상품입니다."); // 온점 주의
            return; 
        } 
        let dom = this.iListMap[idx].dom;
        console.log(dom);
        let clone = dom.cloneNode(true); 

        let sellInfo = document.createElement("div");
        sellInfo.classList.add("sell-info");
        sellInfo.innerHTML = `  <div class="sell-info">
                                    <label>수량</label>
                                    <input type="number" class="cnt" min="1" value="1"> 
                                    <p class="sum">${this.iListMap[idx].priceNum}</p>
                                </div>`;
        clone.querySelector(".text-box").appendChild(sellInfo);
        
        let close = document.createElement("div");
        close.classList.add("close");
        close.innerHTML = `&times;`;
        clone.querySelector(".list-box .img").append(close);
    
        sellInfo.querySelector(".cnt").addEventListener("change", e => {
            sellInfo.querySelector(".sum").innerHTML = e.target.value * this.iListMap[idx].priceNum;
            this.basket[idx] = e.target.value * 1;

            //수량 밑으로 빠지지 않기 위해서 함 ^>^
            if(this.basket[idx] < 1 ) {
                e.target.value = 1;
                sellInfo.querySelector(".sum").innerHTML = e.target.value * this.iListMap[idx].priceNum;
            }

            console.log(this.basket[idx])
            this.calc();    
        });

        close.addEventListener("click", (e)=> {
            clone.remove();
            this.basket[idx] = 0;
            this.calc();
        });

        this.basketZone.appendChild(clone);
        this.basket[idx] = 1;
        this.calc();
    }

    makeTemplate(item) {
        let dom = document.createElement("div");
        dom.classList.add("item");
        dom.innerHTML = `
                        <div class="list-box" data-idx=${item.id}>
                            <div class="img">
                                <img src="./resources/store/상품사진/${item.photo}" alt="img" title="img" draggable="true">
                            </div>
                            <div class="text-box">
                                <p class="brand">${item.brand}</p>
                                <p class="brand-title">${item.product_name}</p>
                                <p class="brand-pr"><b>${item.price}원</b></p>
                            </div>
                        </div>`;   
        dom.querySelector("img").addEventListener("dragstart", this.dragHandle);
        this.iListMap[item.id].dom = dom;
        console.log(dom);
        this.container.appendChild(dom);
    }

    dragHandle = e => {
        let idx = e.target.parentElement.parentElement.dataset.idx;
        e.dataTransfer.setData("idx", idx);
    }
       
    dropHandle  = e => {
        e.preventDefault();
        let idx = e.dataTransfer.getData("idx"); 
        if (idx != ""){
            this.appendBasket(idx);
        }
    };

    calc() {
        console.log("!");
        let iList = document.querySelectorAll(".cart-list > .item");
        let sumPr = 0;
        console.log(iList);
        iList.forEach(x => {
            sumPr += parseInt(x.querySelector(".sum").innerHTML);
        });
        this.totalSum.innerHTML = sumPr;
    }

    buyConfirm = () => {x
        let name = document.querySelector("#name").value;
        let address = document.querySelector("#address").value;

        if(name.trim() == ""){
            alert("이름을 입력하세요");
            return;
        }
        if(address.trim() == ""){
            alert("주소를 입력하세요");
            return;
        }

        this.popup.style.display = "none";
        let result = document.querySelector("#result");

        result.style.display = "flex";

       
        const canvas = document.querySelector("#resultCanvas");
        const ctx = canvas.getContext("2d");
        let fontSize = 45;
        ctx.font = fontSize + "px Arial"; 
        console.log(ctx.font);
       
        let maxLen = "";
        let list = [];
        for(let key in this.basket){
            if(this.basket[key] != 0){ 
                let item = this.iListMap[key];
                item.cnt = this.basket[key]; 
                item.sum = item.priceNum * item.cnt; 
                if(maxLen.length < item.product_name.length){
                    maxLen = item.product_name; 
                }
                list.push(item);
            }
        }

        
        let measure = ctx.measureText(maxLen);
        let width = measure.width;
        
        canvas.height = fontSize * (list.length + 5); 
        canvas.width = width + 200; 
        
    
        ctx.clearRect(0,0, canvas.width, canvas.height); 
        let offset = 10;
        let totalSum = 0;
        for(let i = 0; i <list.length; i++){
            let item = list[i];
            ctx.fillText(item.product_name, offset, (i+1) * fontSize + offset*i );  
            let remainText = `${item.price},  ${item.cnt},  ${item.sum}`;
            ctx.fillText(remainText, 2*offset + width, (i+1) * fontSize + offset*i ); 

            totalSum += item.sum;
        }
        let now = new Date();
       
    
        let lastString = `총합계 : ${totalSum}, 구매일시 : ${now.getFullYear()}-${now.getMonth()}-${now.getDate()} ${now.toLocaleTimeString().substring(3)}`;
        ctx.fillText(lastString, offset, (list.length + 1) * fontSize + offset * list.length );

        this.basketZone.innerHTML = ""; 
        this.basket = {}; 
        this.calc();
    }

    search = (e) => {
        let keyword = document.querySelector("#keyword").value;
        let sList = [];
        
        if(keyword.trim() == ""){
            sList = this.iList;
        }else{
            if(this.cho.includes(keyword[0])){
                for(let i = 0; i < this.iList.length; i++){
                    let {id, photo, product_name, cho_product_name, brand, cho_brand, price} = this.iList[i];        
                    let flag = false;
                    
                    if(cho_product_name.includes(keyword)){
                        let idx = cho_product_name.indexOf(keyword);
                        product_name = `${product_name.substring(0, idx)}<mark>${product_name.substring(idx, idx + keyword.length)}</mark>${product_name.substring(idx + keyword.length)}`;
                        flag = true;
                    
                    }
    
                    if(cho_brand.includes(keyword)){
                        let idx = cho_brand.indexOf(keyword);
                        brand = `${brand.substring(0, idx)}<mark>${brand.substring(idx, idx + keyword.length)}</mark>${brand.substring(idx + keyword.length)}`;
                        flag = true;
                    }
                    if(flag){
                        sList.push({id, photo, product_name, brand, price});
                    }
                }  
            }else {
                for(let i = 0; i < this.iList.length; i++){
                    let {id, photo, product_name, cho_product_name, brand, cho_brand, price} = this.iList[i];        
                    let flag = false;
                    if( product_name.includes(keyword) ) {
                        product_name = product_name.replaceAll(keyword, `<mark>${keyword}</mark>`);
                        flag = true;
                    }
    
                    if( brand.includes(keyword) ) {
                        brand = brand.replaceAll(keyword, `<mark>${keyword}</mark>`);
                        flag = true;
                    }
                    

                    if(flag){
                        sList.push({id, photo, product_name, brand, price});
                    }
                } 
            }       
        }
        if(sList.length == 0) {
            this.container.innerHTML = "일치하지 않습니다.";
        } else {
            this.container.innerHTML = "";
            sList.forEach(x => this.makeTemplate(x));
        }
    
    }
}

window.onload = function() {
    window.app = new App();
}