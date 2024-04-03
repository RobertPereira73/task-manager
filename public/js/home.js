async function access(event) {
    event.preventDefault();

    let form = event.target;
    let response = await getFormResponse(form);
    
    if (response) {
        return redirectDashboard();
    }
}
