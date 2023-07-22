class Footer{
    constructor(){
        console.log('Footer');

        this.injectSocialIconSVGs();
    }

	injectSocialIconSVGs(){
		const fbCode = `<svg width="12" height="21" viewBox="0 0 12 21" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M11.2919 0.337646H8.24318C6.89557 0.337646 5.60315 0.872985 4.65024 1.82589C3.69733 2.7788 3.16199 4.07122 3.16199 5.41884V8.46755H0.113281V12.5325H3.16199V20.6624H7.22694V12.5325H10.2757L11.2919 8.46755H7.22694V5.41884C7.22694 5.14931 7.33401 4.89083 7.52459 4.70025C7.71518 4.50967 7.97366 4.4026 8.24318 4.4026H11.2919V0.337646Z" fill="white"/>
		</svg>`;

		const igCode = `<svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M17.2696 5.91072H17.2801M6.25486 1.33765H16.7451C19.6418 1.33765 21.9902 3.61257 21.9902 6.41884V16.5812C21.9902 19.3875 19.6418 21.6624 16.7451 21.6624H6.25486C3.35808 21.6624 1.00977 19.3875 1.00977 16.5812V6.41884C1.00977 3.61257 3.35808 1.33765 6.25486 1.33765ZM15.696 10.8598C15.8255 11.7056 15.6764 12.5693 15.2699 13.3283C14.8634 14.0872 14.2202 14.7026 13.4319 15.087C12.6435 15.4714 11.7501 15.6052 10.8787 15.4694C10.0073 15.3335 9.20236 14.935 8.57827 14.3304C7.95419 13.7258 7.54278 12.946 7.40256 12.1019C7.26235 11.2577 7.40046 10.3922 7.79726 9.62849C8.19407 8.86477 8.82935 8.2417 9.61276 7.84791C10.3962 7.45412 11.2878 7.30966 12.1608 7.43507C13.0514 7.563 13.8758 7.965 14.5124 8.5817C15.149 9.1984 15.564 9.99709 15.696 10.8598Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>`;

		const twCode = `<svg width="23" height="19" viewBox="0 0 23 19" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M22.9822 0.353969C22.0091 1.04041 20.9316 1.56544 19.7912 1.90881C19.1792 1.20508 18.3658 0.70629 17.461 0.479907C16.5563 0.253524 15.6038 0.31047 14.7325 0.643041C13.8612 0.975613 13.113 1.56776 12.5891 2.33941C12.0653 3.11105 11.7911 4.02496 11.8036 4.95753V5.97376C10.0177 6.02007 8.24808 5.62399 6.65231 4.82079C5.05655 4.01759 3.6842 2.8322 2.65748 1.37021C2.65748 1.37021 -1.40748 10.5163 7.73866 14.5813C5.64575 16.002 3.15254 16.7143 0.625 16.6138C9.77114 21.695 20.9498 16.6138 20.9498 4.92704C20.9488 4.64397 20.9216 4.3616 20.8685 4.08356C21.9056 3.06071 22.6376 1.7693 22.9822 0.353969V0.353969Z" fill="white"/>
		</svg>`;

		const liCode = `<svg width="23" height="23" id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72"><defs><style>.cls-1{fill:#fff;}</style></defs><path class="cls-1" d="m64,0H8C3.58,0,0,3.58,0,8v56c0,4.42,3.58,8,8,8h56c4.42,0,8-3.58,8-8V8c0-4.42-3.58-8-8-8ZM21.77,62h-10.74V27.33h10.74v34.67Zm-5.42-39.21c-3.51,0-6.35-2.86-6.35-6.4s2.84-6.4,6.35-6.4,6.35,2.86,6.35,6.4-2.84,6.4-6.35,6.4Zm45.65,39.21h-10.68v-18.2c0-4.99-1.9-7.78-5.84-7.78-4.3,0-6.54,2.9-6.54,7.78v18.2h-10.3V27.33h10.3v4.67s3.1-5.73,10.45-5.73,12.62,4.49,12.62,13.78v21.95Z"/></svg>
		</svg>`;


		/*
		Desktop
		*/
		// Facebook
		const fbIcon = document.querySelectorAll('footer ul li.icon.fb a');
		for(let fb = 0; fb < fbIcon.length; fb++){
			const fbIconInstance = fbIcon[fb];

			fbIconInstance.innerHTML = fbCode;
		}

		// Instagram
		const igIcon = document.querySelectorAll('footer ul li.icon.ig a');
		for(let ig = 0; ig < igIcon.length; ig++){
			const igIconInstance = igIcon[ig];

			igIconInstance.innerHTML = igCode;
		}

		// Instagram
		const twIcon = document.querySelectorAll('footer ul li.icon.tw a');
		for(let tw = 0; tw < twIcon.length; tw++){
			const twIconInstance = twIcon[tw];

			twIconInstance.innerHTML = twCode;
		}

		// LinkedIn
		const liIcon = document.querySelectorAll('footer ul li.icon.li a');
		for(let li = 0; li < liIcon.length; li++){
			const liIconInstance = liIcon[li];

			liIconInstance.innerHTML = liCode;
		}
	}
}