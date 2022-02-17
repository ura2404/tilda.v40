import Tabs   from '../vendor/wi.cmatrix.ru/Tabs.class.js';
import Ajax   from '../vendor/wi.cmatrix.ru/Ajax.class.js';
import Window from '../vendor/wi.cmatrix.ru/Window.class.js';
import Form   from '../vendor/wi.cmatrix.ru/Form.class.js';
import Alert  from '../vendor/wi.cmatrix.ru/Alert.class.js';

class Module {
    
    // --- --- --- --- ---
    constructor(){
        const Instance = this;
        
        this.$Tabs = $('#cm-module-tabs');
        
        $('.cm-button-remove').on('click',() => this.winConfirmRemove.show());
        
        $('#cm-tab-info').find('.cm-direct')
            .children('.cm-button-info-edit').on('click',() => this.buttonEdit()).end()
            .children('.cm-button-info-cancel').on('click',() => this.buttonCancel()).end()
            .children('.cm-button-info-save').on('click',() => this.buttonSave()).end();
        
        this.formInfo = new Form($('#cm-form-info')
            .find('.cm-lang-add').on('click',function(){ Instance.buttonAddLang(this) }).end()
            .find('.cm-lang-remove').on('click',function(){ Instance.buttonRemoveLang(this) }).end()
        );
        
        this.winConfirmSave = new Window($('#cm-form-save'));
        this.formConfirmSave = new Form($('#cm-form-save'),(url,data) => this.submitInfo(url,data));
        
        this.tabs = new Tabs(this.$Tabs);
        
        //this.winSuccess = new Window($('#cm-alert-success'));
        //this.winSuccess.onHide = function(win){
        //    window.location.href = document.referrer;
        //};
        
        this.alertError = new Alert($('#cm-alert-error'));
        
        this.winConfirmRemove = new Window($('#cm-form-remove'));
        this.formConfirmRemove = new Form($('#cm-form-remove'),(url,data) => this.submitRemove(url,data));
        
        this.Mode = this.$Tabs.data('mode');
    }
    
    // --- --- --- --- ---
    buttonEdit(){
        this.Mode = 'edit';
        this.$Tabs.attr('data-mode',this.Mode);
        this.formInfo.enable();
    }
    
    // --- --- --- --- ---
    buttonCancel(){
        if(this.Mode === 'add') history.back();
        else if(this.Mode === 'edit') {
            this.Mode = 'view';
            this.$Tabs.attr('data-mode',this.Mode);
            this.formInfo.rollback().disable();
        }
    }
    
    // --- --- --- --- ---
    buttonSave(){
        if(!this.formInfo.isRequired()){
            this.alertError.show('Заполните правильно все поля');
        }
        else this.winConfirmSave.show();
    }
    
    // --- --- --- --- ---
    /**
     * Реакция на кнопку "Добавить язык"
     */
    buttonAddLang(button){
        if(this.Mode === 'view') return;
        
        const $Parent = $(button).parent();
        
        const $Button = $Parent.find('button:not(.wi-hidden)').last();
        const $Baloon = $Button.prev();
        const $Lang = $Baloon.prev();
        
        // если есть поля ввода языка и они не заполненные поля, то игнор
        if(($Baloon.find('input').length && $Lang.find('input').length) && (!$Baloon.find('input').val() || !$Lang.find('input').val())) return;
        
        $Parent.find('.wi-hidden').clone(true).removeClass('wi-hidden').each((index,element) => {
            const $Input = $(element).children('input');
            $Input.attr('name',$Input.data('name'));
        }).appendTo($Parent);
    }
    
    // --- --- --- --- ---
    /**
     * Реакция на кнопку "Удалить язык"
     */
    buttonRemoveLang(button){
        if(this.Mode !== 'edit') return;
        
        const $Button = $(button);
        const $Baloon = $Button.prev();
        const $Lang = $Baloon.prev();
        
        $Button.remove();
        $Baloon.remove();
        $Lang.remove();
    }
    
    // --- --- --- --- ---
    submitInfo(url,data){
        new Ajax(
            {url : url},
            data => {
                this.winConfirmSave.hide();
                this.Mode === 'add' ? window.location.href = document.referrer : window.location.reload();
                //history.back();
            },
            data => this.alertError.show(data.message)
        ).commitJson(this.formInfo.data());
    }
    
    // --- --- --- --- ---
    submitRemove(url,data){
        new Ajax(
            {url : url},
            data => {
                this.winConfirmRemove.hide();
                //window.location.reload();
                window.location.href = document.referrer;
                //history.back();
            },
            data => this.alertError.show(data.message)
        ).commitJson(this.formConfirmRemove.data());
    }

    
}

// --- --- --- --- ---
if($('#cm-need-login').length) document.cm.login.winLogin.show(false);
else new Module();