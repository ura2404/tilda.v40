/**
 * Class Pfilter1
 */

import Page from './Page.class.js';

export default class Pfilter1 {
    
    // --- --- --- --- ---
    /**
     * @param $tag - tag контейфнера
     */
    constructor($tag){
        this.$Tag = $tag;
        this.$ActiveButton = this.$Tag.find('.cm-filter-active');
    }
    
    // --- --- --- --- ---
    init(){
        this.$Tag
        
        // ---click по строке label фильтра
        .find('.cm-filter-code').on('click',function(){
            const $Parent = $(this).parent();
            const Code = $Parent.attr('data-code');
            
            if($Parent.hasClass('cm-active')){
                $(this).parent().toggleClass('cm-active');
            }
            else{
                $(this).parent().toggleClass('cm-active');
                $(this).next().find('input').focus();
                
                //const $Popup = $('#cm-filter-popup-'+Code);
                //console.log('#cm-filter-popup-'+Code,$Popup.length);
                
                //if($Popup.length) $Popup.addClass('cm-visible');
            }
        })
        
        // --- кнопка commit
        .end().find('.cm-filter-commit').on('click',() => this.commit())
        // --- кнопка reset
        .end().find('.cm-filter-reset').on('click',() => this.reset())
        // --- кнопка active
        .end().find('.cm-filter-active').on('click',() => this.showActive());
        
        // открыть combobox
        this.$Tag.find('.cm-filter-choice').find('.cm-combobox').on('click',function(){
            $(this).next().toggleClass('cm-active');
        });
        
        // открыть combobox
        this.$Tag.find('.cm-combobox-container').each(function(){
            const $CloseButton = $(this).find('.cm-close-button');
            
            $CloseButton
                .on('click',()=>$(this).removeClass('cm-active'))
                .end()
                .find('.cm-tree-node-label').on('click',function(){
                    const $Node = $(this).parent();
                    const Code = $Node.data('code');
                    const Label = $Node.data('label');
                    
                    $(this).closest('.cm-combobox-container').prev().text(Label).attr('data-value',Code);
                    $CloseButton.trigger('click');
                });
        });
        
        // если есть фильтры активировать кнопку active
        if(this.$Tag.find('.cm-filter-container.cm-active').length) this.$ActiveButton.trigger('click');
    }
    
    // --- --- --- --- ---
    commit(){
        const Values = this.values();
        new Page().init().setParam('f',Values).reload();
    }
    
    // --- --- --- --- ---
    reset(){
        new Page().init().setParam('f').reload();
    }

    // --- --- --- --- ---
    values(){
        let Values = {};
        this.$Tag.find('.cm-filter-container').map((index,element) => {
            const $Current = $(element);
            const $Choice = $Current.find('.cm-active-choice');
            const Type = $Choice.data('type');
            const Code = $Current.closest('.cm-filter-container').data('code');
            
            if(!Type) return;
            
            let Value;
            if(Type === '=') Value = $Choice.find('input').val();
            else if(Type === 'combobox'){
                if(!(Value = $Choice.data('value'))) return;
                //Value += ','+$Choice.text();
                Value = [Value,$Choice.text()];
            }
            
            if(!Value) return;
            
            Values[Code] = {};
            Values[Code][Type] = Value;
        });
        
        if(!Object.keys(Values).length) return null;
        
        Values = JSON.stringify(Values);
            
            //Values = encodeURIComponent(Values);
            //Values = unescape(Values);
            
            Values = encodeURI(Values);
            Values = unescape(Values);
            
        Values = btoa(Values);
        Values = Values.replace(/=+$/,"");
        return Values;
            
        //return Object.keys(Values).length ? btoa(JSON.stringify(Values)).replace(/=+$/,"") : null;
    }
    
    // --- --- --- --- ---
    showActive(){
        this.$Tag
        .find('.cm-filter-active').toggleClass('cm-active')
        .end()
        .find('.cm-filter-container:not(.cm-active)').toggleClass('cm-hidden');
    }
}
