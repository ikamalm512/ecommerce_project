document.addEventListener('DOMContentLoaded', function () {
  
    const colorSelect = document.getElementById('colors');

    
    function updateSelectedColors() {
        Array.from(colorSelect.options).forEach(function(option) {
            const colorValue = option.value;
            
            if (option.selected && colorValue) {
              
                option.style.setProperty('background-color', colorValue, 'important');
                

                if (colorValue === 'red' || colorValue === 'blue' || colorValue === 'black' || colorValue === 'green') {
                    option.style.setProperty('color', 'white', 'important');
                } 
              
                else {
                    option.style.setProperty('color', '#333', 'important'); 
                }

            } else {
             
                option.style.setProperty('background-color', '#ffffff', 'important');
                option.style.setProperty('color', '#333', 'important');
            }
            
            option.style.paddingLeft = '5px'; 
        });
    }

   
    updateSelectedColors(); 
    colorSelect.addEventListener('change', updateSelectedColors);
    colorSelect.addEventListener('focus', updateSelectedColors);


 
    const formGroups = document.querySelectorAll('.card-body .form-group');
    formGroups.forEach((group, index) => {
        group.style.opacity = 0;
        const delay = 0.1 * index; 
        group.style.animation = `fadeInUpStagger 0.6s ease-out ${0.7 + delay}s forwards`;
    });
});