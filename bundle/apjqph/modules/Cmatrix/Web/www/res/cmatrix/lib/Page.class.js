/**
 * Class Page
 */

export default class Page {
    
    // --- --- --- --- ---
    constructor(){
        this.Page;
        this.Params;
    }
    
    init(){
        this.Page = window.location.href.split('?')[0];
        
        /*
        console.log(11,location.search.substring(1));
        console.log(22,location.search.substring(1).replace(/&/g, "\",\""));
        console.log(33,location.search.substring(1).replace(/&/g, "\",\"").replace(/=/g, "\":\""));
        console.log(44,decodeURI(location.search.substring(1).replace(/=+$/, '').replace(/&/g, "\",\"").replace(/=/g, "\":\"")));
        console.log(55,decodeURIComponent(location.search.substring(1).replace(/=+$/, '').replace(/&/g, "\",\"").replace(/=/g, "\":\"")));
        */
        //const Params = location.search.substring(1) ? JSON.parse('{"' + decodeURIComponent(location.search.substring(1).replace(/=+$/, '').replace(/&/g, "\",\"").replace(/=/g, "\":\"")) + '"}') : {};
        this.Params = location.search.substring(1) ? JSON.parse('{"' + decodeURIComponent(location.search.substring(1).replace(/=+$/,"").replace(/&/g, "\",\"").replace(/=/g, "\":\"")) + '"}') : {};
        
        return this;   
    }
    
    setParam(key,value,isCode){
        const IsCode = isCode === undefined ? false : true;
        let Value = value;
        
        if(Value){
            if(isCode){
                Value = JSON.stringify(Value);
                
                //Value = encodeURIComponent(Valuee);
                //Value = unescape(Value);
                
                Value = encodeURI(Value);
                Value = unescape(Value);
                
                Value = btoa(Value);
                Value = Value.replace(/=+$/,"");
                //console.log(Value);
            }            
            this.Params[key] = Value;
        }
        else{
            delete this.Params[key];
        }
        
        return this;
    }
    
    getParam(key,isDecode){
        const IsDecode = isDecode === undefined ? false : true;
        
        let Param = this.Params[key];
        if(!IsDecode || !Param) return Param;
        
        Param = atob(Param);
        Param = JSON.parse(Param);
        return Param;
        
        /*
        let Value = this.Params[key];
        console.log('1=',Value);
        Value = atob(Value);
        console.log('2=',Value);
        Value = unescape(Value);
        console.log('3=',Value);
        Value = decodeURI(Value);
        console.log('4=',Value);
        */
        /*
        Values = JSON.stringify(Values);
        Values = encodeURIComponent(Values);
        Values = unescape(Values);
        Values = btoa(Values);
        Values = Values.replace(/=+$/,"");
        */
        
        //return this.Params[key];
    }
    
    reload(){
        const Href = this.Page + (Object.keys(this.Params).length ? '?'+ decodeURIComponent($.param(this.Params)) : '');
        window.location.href = Href;
    }

}