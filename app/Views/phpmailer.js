let sendbtn = document.querySelector("#send");


$(sendbtn).click(function (){
    let username = document.querySelector("#name").value;
    let email = document.querySelector("#email").value;
    let message = document.querySelector("#message").value;

    console.log('username');
    console.log('email');
    console.log('message');
});

