var radios = document.getElementsByName("user_type_form");
var employer =  document.getElementById("employer_type");
var seasonal =  document.getElementById("seasonal_type");

// Le formulaire employer est sélectionné par défaut
employer.style.display = 'block';
seasonal.style.display = 'none';


for(var i = 0; i < radios.length; i++) {
    radios[i].onclick = function() {
        var val = this.value;
        if(val == 'employer_input'){
            employer.style.display = 'block';
            seasonal.style.display = 'none';
        }
        else if(val == 'seasonal_input'){
            employer.style.display = 'none';
            seasonal.style.display = 'block';
        }

        // val == 'employer_input' ? 'block' : 'none';
        // val == 'employer_input' ? 'none' : 'block';
        //
        // val == 'seasonal_input' ? 'block' : 'none';
        // val == 'seasonal_input' ? 'none' : 'block';

        // val == 'employer_input' ? (
        //     employer.style.display = 'block'
        // ) : (
        //     seasonal.style.display = 'none'
        // );
        //
        // val == 'seasonal_input' ? (
        //     seasonal.style.display = 'block'
        // ) : (
        //     employer.style.display = 'none'
        // );

    }
}