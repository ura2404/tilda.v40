import Window from '../vendor/wi.cmatrix.ru/Window.class.js';
import Form   from '../vendor/wi.cmatrix.ru/Form.class.js';
import Menu   from '../vendor/wi.cmatrix.ru/Menu.class.js';
import Alert  from '../vendor/wi.cmatrix.ru/Alert.class.js';
import Ajax   from '../vendor/wi.cmatrix.ru/Ajax.class.js';

class Login{
    
    // --- --- --- --- ---
    constructor(){
        const Instance = this;
        
        // --- --- --- --- ---
        this.winLogin = new Window($('#cm-form-login'));
        this.winLogin.onShow = win => this.formLogin.enable();
        this.winLogin.onHide = win => this.formLogin.disable();
        this.formLogin = new Form($('#cm-form-login'),(url,data) => this.onSubmit(url,data));
        
        this.winLogout = new Window($('#cm-form-logout'));
        this.formLogout = new Form($('#cm-form-logout'),(url,data) => this.onSubmit(url,data));
        
        this.alertSuccess = new Alert($('#cm-alert-success'));
        this.alertSuccess.Timeout = 2000;
        this.alertSuccess.content('qaz');
        this.alertSuccess.onHide = win => window.location.reload();
        
        this.alertError = new Alert($('#cm-alert-error'));
        this.alertError.onShow = win => win.$CloseButton.focus();
        this.alertError.onHide = win => setTimeout(() => this.formLogin.focus(),100);    // для устранеия дребезга
        
        this.winSession = new Window($('#cm-menu-session'));
        this.menuSession = new Menu($('#cm-menu-session'),{
            '.cm-a-logout' : e => this.winLogout.show()
        });
        this.menuSession.onClick = () => this.winSession.hide();
        
        // --- click по иконке пользователя
        $('#cm-user').on('click',function(){
            if($(this).attr('target') === 'login') Instance.winLogin.show();
            Instance.winSession.show();
        });
    }
    
    // --- --- --- --- ---
    onSubmit(url,data){
        new Ajax(
            { url : url },
            data => this.onSuccess(data),
            data => this.onError(data)
        ).commitJson(data);
    }
    
    // --- --- --- --- ---
    onSuccess(data){
        this.winLogin.hide(true);
        this.winLogout.hide();
        this.alertSuccess.content(data.message).show();
    };
    
    // --- --- --- --- ---
    onError(data){
        this.alertError.content(data.message).show();
    };
}

// --- --- --- --- ---
document.cm.login = new Login();