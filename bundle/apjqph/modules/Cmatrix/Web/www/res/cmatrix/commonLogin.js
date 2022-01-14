import Window from './lib/Window.class.js';
import Form from './lib/Form.class.js';
import Ajax from './lib/Ajax.class.js';

// --- --- --- --- ---
const onSuccess = function(data){
    document.cm.formSuccess.content(data.message).show();
};

// --- --- --- --- ---
const onError = function(data){
    document.cm.formError.content(data.message).show();
};

// --- --- --- --- ---
const onSubmit = function(url,data){
    new Ajax({
        url : url
    },onSuccess,onError).commitJson(data);
};

// --- --- --- --- ---
document.cm.formSuccess = new Window($('#cm-alert-success'));
document.cm.formSuccess.Timeout = 2000;

document.cm.formError = new Window($('#cm-alert-error'));
document.cm.formError.onShow = function(win){
    win.$CloseButton.focus();
};
document.cm.formError.onHide = function(win){
    setTimeout(() => document.cm.formLogin.focus(),100);    // для устранеия дребезга
};

document.cm.formLogin = new Form($('#cm-form-login'),onSubmit);
document.cm.formSession = new Form($('#cm-form-session'),onSubmit);

// 2. click по иконке пользователя
$('#cm-user').on('click',function(){
    if($(this).attr('target') === 'login')document.cm.formLogin.show();
    else document.cm.formSession.show();
});
