/**
 * Class Menu
 */

import Window from './Window.class.js';

export default class Menu{
    
    // --- --- --- --- ---
    constructor($tag,onClicks){
        const Instance = this;
        this.$Tag = $tag;
        this.onClick = function(e){};
        
        onClicks = onClicks || {};
        
        // --- init
        Object.keys(onClicks).forEach(function(key){
            Instance.$Tag.find(key).on('click',e => {
                this[key].call(e.target);
                Instance.onClick(e);
            });
        },onClicks);
    }

}