/**
 * Created by kutas on 5/23/17.
 */

export default class Steps {
    constructor (config){
        this.steps = config.steps;
        this.current = this.defaultStep =  config.defaultStep;
        this.passed = [];
    }

    is(name){
        return this.current === name;
    }

    set(name){
        this.current = name;
        this.updatePassedSteps();
    }
    nextStep(){
        this.set(this.getNextStepName());
    }
    prevStep(step = null){

        this.set(this.getCurrentStepIndex()-1);

    }
    getNextStepName(){
        return this.steps[this.getCurrentStepIndex()+1];
    }
    getCurrentStepIndex(){
        return _.indexOf(this.steps, this.current);
    }

    updatePassedSteps(){
        this.passed = _.slice(this.steps, 0, this.getCurrentStepIndex());
    }

    isPassed(step){
        return _.includes(this.passed, step);
    }




}