const alertContainer = document.getElementById('alert-container');

function addAlert(message) {
    const alertDiv = document.createElement('div');
    alertDiv.innerText = message;

    alertContainer.append(alertDiv);

    alertDiv.animate([
        {opacity: '1'},
        {opacity: '1'},
        {opacity: '0'}
    ], {
        duration: 5000
    }).onfinish = () => {
        alertDiv.remove();
    }
}

