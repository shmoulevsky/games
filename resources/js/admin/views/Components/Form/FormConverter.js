export default class FormConverter{

    convert(data) {

        let result = {};
        result.translations = {};

        for (let key in data.tabs){

            if(data.tabs[key].languages === true){
                for(let translation in data.tabs[key].translations){
                    result.translations[data.tabs[key].translations[translation].id] = {};
                    for(let field in data.tabs[key].translations[translation].fields){
                        result.translations[data.tabs[key].translations[translation].id][field] = data.tabs[key].translations[translation].fields[field].value;
                    }
                }

            }else {
                for(let field in data.tabs[key].fields){
                    result[field] = data.tabs[key].fields[field].value;
                }
            }

        }

        return result;
    }
}
