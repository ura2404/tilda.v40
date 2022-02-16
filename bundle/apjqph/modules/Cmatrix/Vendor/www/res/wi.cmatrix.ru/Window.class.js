/**
 * Class Window
 * 
 * Необходимые элементы
 *  - .wi-back - подложка окна
 *  - .wi-a-close - кнопка закрытия окна
 */

import Common from './Common.class.js';
import Esc from './Esc.class.js';

export default class Window extends Common {
    // --- --- --- --- ---
    /**
     * @param $tag - tag окна
     */
    constructor($tag){
        super();
        
        this.$Tag = $tag;
        this.$Back = this.$Tag.closest('.wi-back');
        this.$CloseButton = this.$Tag.find('.wi-a-close');
        
        this.Timeout = this.$Tag.data('timeout') || 0;
        this.isHidable = true;
        
        this.onShow = undefined;
        this.onHide = undefined;
        
        this.Content = undefined;
        
        // --- init --- --- --- ---
        this.$CloseButton.on('click',() => setTimeout(() => this.hide(),100));
    }
    
    // --- --- --- --- ---
    content(value){
        this.Content = value;
        return this;
    }
    
    // --- --- --- --- ---
    show(isHidable){
        //console.log('windows.show()',this.Timeout);
        const Instance = this;
        
        this.isHidable = isHidable;
        
        // --- --- --- --- ---
        this.$Tag.find('.wi-content').html(this.Content);
        
        // --- --- --- --- ---
        // если форма не закрывемая, удалить кнопку закрытия
        if(this.isHidable === false) this.$CloseButton.hide();
        
        this.$Back
            .on('click',() => Instance.hide())
            //.removeClass('wi-behind').addClass('wi-opend');
            .removeClass('wi-behind').delay(0).queue(function(){ $(this).addClass('wi-opend'); $(this).dequeue(); });
            
        // --- --- --- --- ---
        // если обозначет timeout, то закрыть отреагировать на это
        if(this.Timeout) this.Timer = setTimeout(function(){
            Instance.hide();
        },this.Timeout);
        
        // --- --- --- --- ---        
        // не передавать click на форме нижестоящим элементам
        this.$Tag.on('click',e => e.stopPropagation());
        
        // --- --- --- --- ---        
        Esc.push(function(){ Instance.hide() });
        if(typeof this.onShow === 'function') this.onShow(Instance);
        
        return this;
    }    
    
    // --- --- --- --- ---
    hide(force){
        //console.log('windows.hide()');
        const Instance = this;
        
        // если форма не закрывемая, не закрывать
        if(!force && this.isHidable === false) return this;
        
        clearTimeout(this.Timer);
        
        // --- --- --- --- ---
        this.$Back
            .off()
            .removeClass('wi-opend').addClass('wi-behind');
            //.removeClass('cm-opend').delay(0).queue(function(){ $(this).addClass('cm-behind'); $(this).dequeue(); });
            
        // --- --- --- --- ---        
        Esc.pop();
        if(typeof this.onHide === 'function') this.onHide(Instance);
        
        return this;
    }
}