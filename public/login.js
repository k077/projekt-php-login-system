const logInFormElement = document.getElementById('login-form');
const registerFormElement = document.getElementById('register-form');
const logOutBtn = document.getElementById('log-out-btn');
const usernameDisplay = document.getElementById('username-display');
const loginRegisterContainer = document.getElementById('login-register-container');
const contentContainer = document.getElementById('protected-content');

function getUserList() {
    fetch('http://localhost/api/get-user-list.php', {
        method: 'post',
        credentials: 'include'
    }).then(response => response.json().then(
        res => {
            contentContainer.innerHTML = '';
            if(Array.isArray(res) && res.length > 0){
                contentContainer.innerText = 'Nasi użytkownicy:';
                const ulElement = document.createElement('ul');
                for(const user of res) {
                    const liElement = document.createElement('li');
                    liElement.innerText = user['username'];
                    ulElement.append(liElement);
                }
                contentContainer.append(ulElement);
            }
        }
    ));
}
function updateInfo(status) {
    const logged = !!status['user'];
    logOutBtn.style.display = logged ? 'inherit' : 'none';
    loginRegisterContainer.style.display = logged ? 'none' : 'inherit'
    usernameDisplay.innerText = logged
        ? `Zalogowano jako: ${status['user']?.['username']}`
        : '';
    getUserList();
}
{
    logInFormElement.addEventListener('submit', e => {
        e.preventDefault();
        fetch(logInFormElement.action, {
            method: 'post',
            credentials: 'include',
            body: new FormData(logInFormElement)
        }).then(response => response.json()
            .then(
                res => {
                    const msg = res['logInStatus']?.['success']
                        ? `Zalogowano pomyślnie jako: ${res['user']?.['username']}`
                        : res['logInStatus']?.['error'];
                    updateInfo(res);
                    addAlert(msg);
                }
            ))
    });
}
{
    registerFormElement.addEventListener('submit', e => {
        e.preventDefault();
        fetch(registerFormElement.action, {
            method: 'post',
            credentials: 'include',
            body: new FormData(registerFormElement),
        }).then(response => response.json()
            .then(
                res => {
                    const msg = res['registrationStatus']?.['success']
                        ? `Zarejestrowano pomyślnie użytkownika: ${res['user']?.['username']}`
                        : res['registrationStatus']?.['error'];
                    addAlert(msg);
                }
            ))
    });
}
{
    logOutBtn.addEventListener('click', () => {
        fetch('http://localhost/api/logout.php', {
            method: 'post',
            credentials: 'include'
        }).then(response => response.json().then(
            res => {
                addAlert('Wylogowano pomyślnie');
                updateInfo(res);
            }
        ));
    });
}
{
    fetch('http://localhost/api/get-session-status.php', {
        method: 'post',
        credentials: 'include'
    }).then(response => response.json().then(
        res => {
            updateInfo(res);
        }
    ));
}
