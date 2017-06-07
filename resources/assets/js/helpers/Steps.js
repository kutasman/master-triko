/**
 * Created by kutas on 5/23/17.
 */

export default class Tabs {
    constructor (tabNames, defaultTab){
        this.tabs = tabNames;
        this.current = this.defaultTab =  defaultTab;
    }

    is(name){
        return this.current === name;
    }

    set(name){
        this.current = name;
    }

}