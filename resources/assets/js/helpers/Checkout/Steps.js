/**
 * Created by kutas on 5/23/17.
 */

export default class Steps {
    constructor (config){
        this.steps = config.steps;
        this.current = this.defaultStep =  config.defaultStep;
    }

    is(name){
        return this.current === name;
    }

    set(name){
        this.current = name;
    }
    nextStep(){
        this.set(this.getNextStepName());
    }
    getNextStepName(){
        return this.steps[this.getCurrentStepIndex()+1];
    }
    getCurrentStepIndex(){
        return _.indexOf(this.steps, this.current);
    }

}