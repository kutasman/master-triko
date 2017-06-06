/**
 * Created by kutas on 6/7/17.
 */
export default class Referee {

    constructor(rules){

        this.rules = rules;

    }


    isModDisabled(mod_id, modificators){

        let results = [];

        let rules = this.getRelevantRules(mod_id, 'disabled');

        if (rules.length && modificators.length){

            _.forEach(rules, rule => {
                if (!_.isUndefined(this.getModificator(rule.toggle_id, modificators))){

                    results.push(this.getModificator(rule.toggle_id, modificators).value === rule.toggle_option_id);

                } else {
                    results.push(false);
                }
            });

        }

        return results.includes(true);

    }

    getAccordance(modificators){


        return _.map(this.rules, rule => {
            if (!_.isUndefined(this.getModificator(rule.toggle_id, modificators))){

                return this.getModificator(rule.toggle_id, modificators).value === rule.toggle_option_id;

            } else {

                return false;

            }
        })
    }

    getModificator(mod_id, modificators){

        return _.find(modificators, mod => { return mod.mod.id === mod_id});

    }

    getRelevantRules(mod_id, action){

        return this.rules.filter(rule => {

            return mod_id === rule.target_id && rule.action === action;

        });
    }

}