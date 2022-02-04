import Window from '../vendor/wi.cmatrix.ru/Window.class.js';
import Form from '../vendor/wi.cmatrix.ru/Form.class.js';
import Menu from '../vendor/wi.cmatrix.ru/Menu.class.js';
import Ajax from '../vendor/wi.cmatrix.ru/Ajax.class.js';

// --- --- --- --- ---
const onSuccess = function(data){
    document.cm.winLogin.hide(true);
    document.cm.winLogout.hide();
    document.cm.winSuccess.content(data.message).show();
};

// --- --- --- --- ---
const onError = function(data){
    document.cm.winError.content(data.message).show();
};

// --- --- --- --- ---
const onSubmit = function(url,data){
    new Ajax({
        url : url
    },onSuccess,onError).commitJson(data);
};

// --- --- --- --- ---
document.cm.winSuccess = new Window($('#cm-alert-success'));
//document.cm.winSuccess.Timeout = 2000;
document.cm.winSuccess.onHide = function(win){
    window.location.reload();
};

// --- --- --- --- ---
document.cm.winError = new Window($('#cm-alert-error'));
document.cm.winError.onShow = win => win.$CloseButton.focus();
document.cm.winError.onHide = win => setTimeout(() => document.cm.formLogin.focus(),100);    // для устранеия дребезга

// --- --- --- --- ---
document.cm.formLogin = new Form($('#cm-form-login'),onSubmit);
document.cm.formLogout = new Form($('#cm-form-logout'),onSubmit);

// --- --- --- --- ---
document.cm.winLogin = new Window($('#cm-form-login'));
document.cm.winLogin.onShow = win => document.cm.formLogin.on();
document.cm.winLogin.onHide = win => document.cm.formLogin.off();

// --- --- --- --- ---
document.cm.winLogout = new Window($('#cm-form-logout'));

// --- --- --- --- ---
document.cm.winSession = new Window($('#cm-menu-session'));

// --- --- --- --- ---
document.cm.menuSession = new Menu($('#cm-menu-session'),{
    '.cm-a-logout' : e => document.cm.winLogout.show()
});
document.cm.menuSession.onClick = () => document.cm.winSession.hide();

// --- click по иконке пользователя
$('#cm-user').on('click',function(){
    if($(this).attr('target') === 'login') document.cm.winLogin.show();
    else document.cm.winSession.show();
});