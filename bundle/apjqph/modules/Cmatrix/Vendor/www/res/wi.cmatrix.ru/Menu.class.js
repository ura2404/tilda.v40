/**
 * Class Menu
 */

import Window from './Window.class.js';

export default class Menu extends Window {
    
    // --- --- --- --- ---
    constructor($tag,onClicks){
        super($tag);
        
        const Instance = this;
        
        onClicks = onClicks || {};
        
        Object.keys(onClicks).forEach(function(key){
            Instance.$Tag.find(key).on('click',e => this[key].call(e.target));
        },onClicks);
    }
    
    // --- --- --- --- ---
    init(){
        const Instance = this;
        
        /*this.$Tag.find('li').on('click', e => {
            console.log('click',e);
            e.stopPropagation();
        });*/
        
        Object.keys(this.onClicks).forEach(function(key){
            Instance.$Tag.find(key).on('click',e => this[key].call(e.target));
        },this.onClicks);
        
        return this;
    }
    
}