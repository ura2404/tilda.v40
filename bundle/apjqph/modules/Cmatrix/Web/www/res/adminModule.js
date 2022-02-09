import Tabs from '../vendor/wi.cmatrix.ru/Tabs.class.js';
import Ajax from '../vendor/wi.cmatrix.ru/Ajax.class.js';
import Window from '../vendor/wi.cmatrix.ru/Window.class.js';
import Form from '../vendor/wi.cmatrix.ru/Form.class.js';

if($('#cm-need-login').length) document.cm.winLogin.show(false);

class Module {
    
    // --- --- --- --- ---
    constructor(){
        const Instance = this;
        
        this.$Tag = $('#cm-module-tabs');
        this.$FormInfo = $('#cm-form-info');
        this.$FormConfirm = $('#cm-form-confirm');
        this.$ButtonEdit = $('#cm-button-module-edit').on('click',() => this.enableEdit());
        this.$ButtonSave = $('#cm-button-module-save').on('click',() => this.save());
        this.$ButtonAddLang = this.$FormInfo.find('.cm-lang-add').on('click',function(){ Instance.addLang(this) });
        this.$ButtonRemoveLang = this.$FormInfo.find('.cm-lang-remove').on('click',function(){ Instance.removeLang(this) });
        this.$ButtonBack = $('#cm-button-back').on('click',() => {
            console.log(this.Mode);
            if(this.Mode === 'view') history.back();
            else this.disableEdit();
        });
        
        this.tabs = new Tabs(this.$Tag);
        this.formInfo = new Form(this.$FormInfo);
        
        this.winConfirm = new Window(this.$FormConfirm);
        this.winConfirm.content('Сохранить изменения?');
        
        this.formConfirm = new Form(this.$FormConfirm,(url,data) => this.submit(url,data));
        
        //this.winSuccess = new Window($('#cm-alert-success'));
        //this.winSuccess.onHide = function(win){
        //    window.location.href = document.referrer;
        //};
        
        this.winError = new Window($('#cm-alert-error'));
        
        this.Mode = this.$Tag.data('mode');

    }
    
    // --- --- --- --- ---
    enableEdit(){
        this.Mode = 'edit';
        this.$FormInfo.removeAttr('disabled').find('input,textarea').removeAttr('disabled');
        this.$ButtonEdit.addClass('wi-hidden').next().removeClass('wi-hidden');
    }

    // --- --- --- --- ---
    disableEdit(){
        this.Mode = 'view';
        this.$FormInfo.attr('disabled','disabled').find('input,textarea').attr('disabled','disabled');
        this.$ButtonSave.addClass('wi-hidden').prev().removeClass('wi-hidden');
    }
    
    // --- --- --- --- ---
    /**
     * Реакция на кнопку "Добавить язык"
     */
    addLang(button){
        if(this.$FormInfo.attr('disabled') === 'disabled') return;
        
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
    removeLang(button){
        if(this.$FormInfo.attr('disabled') === 'disabled') return;
        
        const $Button = $(button);
        const $Baloon = $Button.prev();
        const $Lang = $Baloon.prev();
        
        $Button.remove();
        $Baloon.remove();
        $Lang.remove();
    }
    
    // --- --- --- --- ---
    /**
     * Реакция на кнопку "Сохранить"
     */
    save(){
        if(!this.formInfo.isRequired()) return;
        this.winConfirm.show();
        
        
        //this.disableEdit(); 
        //this.winConfirm.show();
    }
    
    // --- --- --- --- ---
    submitSuccess(data){
        this.winConfirm.hide();
        //this.winSuccess.content(data.message).show();
        
        //history.back();
        window.location.href = document.referrer;
    }
        
    // --- --- --- --- ---
    submitError(data){
        this.winError.content(data.message).show();
    }
    
    // --- --- --- --- ---
    submit(url,data){
        const Data = this.formInfo.data();
        
        new Ajax({
            url : url
        },data => this.submitSuccess(data),data => this.submitError(data)).commitJson(Data);
    }
    
}

// --- --- --- --- ---
new Module();
