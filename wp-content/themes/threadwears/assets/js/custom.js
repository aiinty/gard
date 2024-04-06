/**
 * Custom JS for theme elements
 */

/**
 * WooCommerce active class for category list
 */
let url = window.location.href;
let catLink = document.querySelectorAll(".wc-block-product-categories-list li a");
catLink.forEach((item) => {
	if (item.href === url) {
		item.classList.add("active");
	}
});

//T&C box checked on click
let threadwearsCheckDivTerms = document.querySelector('.woocommerce-terms-and-conditions-checkbox-text');
if (threadwearsCheckDivTerms !== null) {
	threadwearsCheckDivTerms.onclick = function (e) {
		this.classList.toggle('checked');
	}
}

// Plus minus function added on product input counter
function threadwearsQtyChange() {
	let qtyWrap = document.querySelectorAll('.quantity');
	qtyWrap.forEach((wrap) => {
		let qNav = document.createElement('div');
		let qUp = document.createElement('div');
		let qDown = document.createElement('div');
		let input = wrap.querySelectorAll('.qty');
		qUp.innerHTML = '+';
		qDown.innerHTML = '-';
		qNav.appendChild(qUp);
		qNav.appendChild(qDown);
		wrap.appendChild(qNav)
		qUp.setAttribute('class', 'quantity-button quantity-up');
		qDown.setAttribute('class', 'quantity-button quantity-down');
		max = 99999;
		let min = '';
		input.forEach((inputItem) => {
			min = inputItem.getAttribute('min');
			if (qtyWrap.length > 1) {
				// Set default value to 0
				inputItem.value = 0;
			}
			qNav.setAttribute('class', 'quantity-nav');
			let btnUp = wrap.querySelectorAll('.quantity-up');
			btnUp.forEach((btnItem) => {
				btnItem.addEventListener('click', function () {
					let oldValue = parseFloat(inputItem.value);
					if (oldValue >= max) {
						var newVal = oldValue;
					} else {
						var newVal = oldValue + 1;
					}
					inputItem.value = newVal
					var element = document.createEvent('HTMLEvents');
					var event = new Event('change', {
						bubbles: true
					});
					inputItem.dispatchEvent(event);
					return event;
				})
			})
			let btnDown = wrap.querySelectorAll('.quantity-down');
			btnDown.forEach((btnItem) => {
				btnItem.addEventListener('click', function () {
					let oldValue = parseFloat(inputItem.value);
					if (oldValue >= max) {
						var newVal = oldValue;
					} else if (oldValue <= 0) {
						var newVal = 0;
					} else {
						var newVal = oldValue - 1;
					}
					inputItem.value = newVal
					var element = document.createEvent('HTMLEvents');
					var event = new Event('change', {
						bubbles: true
					});
					inputItem.dispatchEvent(event);
					return event;
				})
			})
		})
	})
}
threadwearsQtyChange();

function threadwearsCartUpdate() {
	let btnTrigger = document.querySelector('button[name="update_cart"]');
	if (btnTrigger !== null) {
		btnTrigger.addEventListener('click', function () {
			setTimeout(function () {
				threadwearsQtyChange();
			}, 5000);
			setTimeout(function () {
				threadwearsCartUpdate();
			}, 5000);
		});
	}
}
threadwearsCartUpdate();

// Added to cart text change when product added
let cartBtn = document.querySelectorAll('.add_to_cart_button');
if (cartBtn !== null) {
	cartBtn.forEach((item) => {
		let text = 'added to cart';
		item.addEventListener('click', function () {
			item.innerHTML = text;
		});
	});
}


// Cusstom Checkboxs for Checkout Page
let checkDivAccount = document.querySelector('.woocommerce-account-fields .checkbox span');
if (checkDivAccount !== null) {
	checkDivAccount.onclick = function (e) {
		this.classList.toggle('checked');
	}
}

document.addEventListener('click', function (event) {
	if (event.target.classList.contains('woocommerce-terms-and-conditions-checkbox-text')) {
		event.target.classList.toggle('checked');
	}
});

let checkDivShipping = document.querySelector('.woocommerce-shipping-fields .checkbox span');
if (checkDivShipping !== null) {
	checkDivShipping.onclick = function (e) {
		this.classList.toggle('checked');
	}
}

// Sticky Mobile Icon Menu body padding bottom
let fixedMenu = document.querySelector('.wp-mobile-icon-menu');
if (fixedMenu !== null) {
	document.body.style.paddingBottom = `${fixedMenu.clientHeight}px`;
}
