async function getFormResponse(form) {
    let formData = new FormData(form);
    let config = configObj(form.method, formData);
    let response = await sendData(form.action, config);

    cleanErrors(form);
    let errors = response.errors; 
    if (errors) return httpErrors(errors, form);
    
    return response;
}

function configObj(method, body={}) {
    let _token = metaToken();
    
    return {
        method: method,
        headers: {
            'X-CSRF-TOKEN': _token,
            'Accept': "application/json, text-plain, */*",
        },
        body: body
    }
}

async function sendData(url, config) {
    let request = await fetch(url, config);
    let response = await request.json();

    return response;
}

function cleanErrors(form) {
    let oldErrors = form.querySelectorAll('span.text-danger');
    oldErrors.forEach(error => error.remove());
}

function httpErrors(errors, form) {
    for (let inputName in errors) {
        let formGroup = searchGroup(form, `.form-group:has(input[name="${inputName}"])`);
        let errorList = errors[inputName];

        errorList.forEach(error => {
            formGroup.innerHTML += `<span class="text-danger">${error}</span>`
        });
    }
}

function searchGroup(element, selector) {
    return element.querySelector(selector);
}

function metaToken() {
    return document.querySelector('meta[name="_token"]').content;
}

function redirectDashboard() {
    location.href = '/dashboard';   
}