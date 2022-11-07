window.onload = function() {
    window.cartAdd = function(product_id) {
        axios.post('/checkout/add', {
            product_id: product_id,
        }).then(response => {
            if (response.data) {
                document.getElementById('message').innerText = response.data;
                document.getElementById('alert-danger').classList.remove('hidden');
            } else {
                location.reload();
            }
        }).catch(err => {
            console.log(err.response.data);
        })
    }

    window.reduceQuantity = function(id) {
        axios.post('/checkout/change-quantity', {
            id: id,
        }).then(response => {
            location.reload();
        }).catch(err => {
            console.log(err.response.data);
        })
    }

    let regForm = document.getElementById('reg-form');
    if (regForm) {
        regForm.addEventListener("submit", function(e) {
            e.preventDefault();
            let elements = regForm.querySelectorAll('p');
            let inputs = regForm.getElementsByClassName('border-red-500');
            for (let elem of elements) {
                elem.innerHTML = '';
            }
            for (let input of inputs) {
                input.classList.remove('border-red-500');
            }
            if (!regForm.elements.rules.checked) {
                document.getElementById('rules-checkbox-text').classList.remove('hidden');
                return false;
            }
            axios.post(regForm.action, {
                name: regForm.elements.name.value,
                surname: regForm.elements.surname.value,
                patronymic: regForm.elements.patronymic.value,
                login: regForm.elements.login.value,
                email: regForm.elements.email.value,
                password: regForm.elements.password.value,
                password_confirmation: regForm.elements.password_confirmation.value,
                rules: regForm.elements.rules.value,
            }).then(response => {
                window.location.replace("/");
            }).catch(err => {
                if ('errors' in err.response.data) {
                    let errorsArr = err.response.data.errors;
                    for (let [key, value] of Object.entries(errorsArr)) {
                        document.getElementById(key).classList.add('border-red-500');
                        document.getElementById(key + '-message').innerText = value;
                    }
                    console.log(err.response.data);
                }
            })

            return false;
        })
    }

    let checkoutForm = document.getElementById('checkout-form');
    if (checkoutForm) {
        checkoutForm.addEventListener("submit", function(e) {
            e.preventDefault();
            let elements = checkoutForm.querySelectorAll('p');
            let inputs = checkoutForm.getElementsByClassName('border-red-500');
            for (let elem of elements) {
                elem.innerHTML = '';
            }
            for (let input of inputs) {
                input.classList.remove('border-red-500');
            }
            axios.post(checkoutForm.action, {
                password: checkoutForm.elements.password.value,
            }).then(response => {
                window.location.replace("checkout/success");
            }).catch(err => {
                console.log(err.response);
                if (err.response.data.errors) {
                    document.getElementById('password').classList.add('border-red-500');
                    document.getElementById('password-message').innerText = err.response.data.errors.password[0];
                }
                return false;
            })
        })
    }

    const targetEl = document.getElementById('dropdownNavbarLink');
    const triggerEl = document.getElementById('dropdownNavbar');

    const options = {
        triggerEl: triggerEl,
        onCollapse: () => {
            console.log('element has been collapsed')
        },
        onExpand: () => {
            console.log('element has been expanded')
        },
        onToggle: () => {
            console.log('element has been toggled')
        }
    };
    const collapse = new Collapse(targetEl, options);
};
