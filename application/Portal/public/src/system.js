
function parseJwt (token) {
    if (!token) {
        return null;
    }
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
};

let auth = {
    requestLogin: function (email, password, callback)
    {
        $.ajax({
            method: "POST",
            url: "http://localhost:60001/v1/access/auth",
            data: JSON.stringify({
                email: email,
                senha: password
            }),
            cache: false,
            processData: false,
            contentType: 'application/json',
        }).done(function (result) {
            localStorage.setItem('TecnofitAuthorization', result.jwt);
            // window.location.reload();
            callback({
                status: 200,
                message: "Usuário autenticado com sucesso"
            });
        }).fail(function (result) {
            callback({
                status: 400,
                message: result.responseJSON.errors[0].message
            });
        });
    },

    getCurrentTime: function () {
        return parseInt((new Date()).getTime() / 1000);
    },

    validateExpiration: function () {
        data = this.getUserData();
        return data.exp > this.getCurrentTime();
    },

    getUserData: function ()
    {
        let jwt = localStorage.getItem('TecnofitAuthorization');
        let data = parseJwt(jwt);
        data.jwt = jwt;
        return data;
    },

    logout: function ()
    {
        localStorage.setItem('TecnofitAuthorization', "");
        window.location = "/login";
    }
};

let modal = {
    showMessage: function (message, type="success", expire=5000) {
        if (!$("#generalErrorMessageModal").length) {
            $("body").prepend($("<div id='generalErrorMessageModal'/>"));
        }

        let style = 'background-color: green;';
        
        if (type == "error") {
            style = 'background-color: red;';
        }

        let elem = $(`
            <div style="position: fixed;
                        top: 100px;
                        left: 20px;
                        min-width: 200px;
                        min-height: 40px;
                        border-radius: 8px;
                        color: #fff;
                        text-align: center;
                        padding: 10px 16px;
                        font-weight: bolder;`+style+`"></div>
        `);

        elem.html(message);
        $("#generalErrorMessageModal").append(elem);
        setTimeout(function () {
            elem.fadeOut();
        }, expire);
    },
};

$(function () {
    if ((!localStorage.getItem('TecnofitAuthorization') || !auth.validateExpiration()) && window.location.pathname != "/login/") {
        window.location = "/login/";
    }
});