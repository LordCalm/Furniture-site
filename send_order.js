async function sendOrder() {
    try {
        let response = await fetch(document.forms.order.action, {
            method: 'post',
            body: new FormData(document.forms.order)
        });
        if (response.ok) {
            let result = await response.json();
            document.forms.order.querySelectorAll('.error').forEach(el => {
                el.textContent = '';
            });
            if (result['result'] === 'error') {
                const errors = result['error'];
                for (const [key, value] of Object.entries(errors)) {
                    document.forms.order.querySelector(`[name="${key}"]`).nextElementSibling.textContent = value;
                    document.forms.order.querySelector(`[name="${key}"]`).closest('.form-group').classList.add('empty-field');
                }
            } else {
                document.forms.order.reset();
                document.querySelector('.result').classList.add('form-success');
                var formGroup = document.forms.order.querySelectorAll('.form-group');
                for( i in formGroup) {
                    formGroup[i].classList.remove('empty-field');
                }
            }
        }
    }
    catch (error) {
        console.log(error);
    }
}

function validation() {
    document.forms.order.querySelector(`[name="name"]`).value = document.forms.order.querySelector(`[name="name"]`).value.replace(/ +/g, ' ').replace(/[^А-яЁё ]/g,"").trim();
    document.forms.order.querySelector(`[name="surname"]`).value = document.forms.order.querySelector(`[name="surname"]`).value.replace(/ +/g, ' ').replace(/[^А-яЁё ]/g,"").trim();
    document.forms.order.querySelector(`[name="message"]`).value = document.forms.order.querySelector(`[name="message"]`).value.replace(/ +/g, ' ').replace(/[^А-яЁё ]/g,"").trim();
}

document.forms.order.onsubmit = (e) => {
    e.preventDefault();
    validation();
    sendOrder();
}

document.querySelector('.result__close').onclick = (e) => {
    e.target.closest('.result').classList.toggle('form-success');
}