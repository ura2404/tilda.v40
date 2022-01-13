import Window from './lib/Window.class.js';
import Form from './lib/Form.class.js';
import Ajax from './lib/Ajax.class.js';

// --- --- --- --- ---
const onSuccess = function(data){
    alert('success',data);
};

// --- --- --- --- ---
const onError = function(data){
    alert('error',data);
};

// --- --- --- --- ---
const onSubmit = function(url,data){
    new Ajax({
        url : url
    },onSuccess,onError).commitJson(data);
};

// --- --- --- --- ---
document.cm.formSuccess = new Window($('#cm-alert-success'));
document.cm.formError = new Window($('#cm-alert-error'));

document.cm.formLogin = new Form($('#cm-form-login'),onSubmit);

// 2. click по иконке пользователя
$('#cm-user').on('click',() => document.cm.formLogin.show());
