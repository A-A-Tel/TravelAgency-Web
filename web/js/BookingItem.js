class BookingItem extends HTMLElement {

    constructor() {
        super();

        this._shadow = this.attachShadow({mode: "open"});
    }

    connectedCallback() {

        const forms = document.getElementById("forms");

        this._shadow.innerHTML = `
            
            <button onclick="enterItemPage(${this.id})""></button>
            <h2>${this.getAttribute("loc") ?? "Lorem"} - ${this.getAttribute("name") ?? "ipsum"}</h2>
            <span>
                <button style="background: #F00">-</button>
                <button style="background: #0e7a0e">+</button>
            </span>
           
            
            <style>
                :host {
                    width: 20vw;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                :host button {
                    width: 20vw;
                    height: 20vw;
                    background: #004D3E url('${"/img/travel-items/" + (this.id !== "" ? this.id : "../placeholder.svg")}') no-repeat center / 100% 100%;
                    overflow: hidden;
                    color: inherit;
                    border: none;
                    cursor: pointer;
                }
                :host button::after {
                    content: '${"€" + (this.getAttribute("price") ?? "XX,XX")}';
                    position: relative;
                    width: 10vw;
                    height: 10vw;
                    background: #00FFA2;
                    border-radius: 50%;
                    left: 11.5vw;
                    top: 7vw;
                    display: grid;
                    place-items: center;
                    font-family: 'concert-one', sans-serif;
                    font-size: 1.8vw;
                }
                :host h2 {
                    font-family: 'concert-one', sans-serif;
                    font-size: 1.7vw;
                    text-align: center;
                }
                :host span {
                    display: flex;
                    gap: 5vw;
                    
                }
                :host span button {
                    border: none;
                    border-radius: 4vw;
                    outline: none;
                    cursor: pointer;
                    width: 5vw;
                    height: 3vw;
                    font-size: 2vw;
                    color: #FFF;
                    font-family: 'concert-one', sans-serif;
                }
            </style>
        `;
    }
}

customElements.define("booking-item", BookingItem);