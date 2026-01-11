

document.addEventListener('DOMContentLoaded', () => {
   
    const elements = {
        display: document.getElementById('passwordDisplay'),
        slider: document.getElementById('passwordLength'),
        lengthLabel: document.getElementById('lengthValue'),
        copyBtn: document.getElementById('copyBtn'),
        indicator: document.getElementById('strengthIndicator'),
        decrement: document.querySelector('.length-decrement'),
        increment: document.querySelector('.length-increment')
    };

  
    const chars = {
        upper: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        lower: 'abcdefghijklmnopqrstuvwxyz',
        numbers: '0123456789',
        symbols: '!@#$%^&*()_+~`|}{[]:;?><,./-=',
        space: ' '
    };

    
    function generatePassword() {
        if (!elements.display || !elements.slider) return;

        const length = parseInt(elements.slider.value);
        const options = {
            upper: document.getElementById('includeUppercase')?.checked,
            lower: document.getElementById('includeLowercase')?.checked,
            numbers: document.getElementById('includeNumbers')?.checked,
            symbols: document.getElementById('includeSymbols')?.checked,
            spaces: document.getElementById('includeSpaces')?.checked
        };

        let pool = "";
        if (options.upper) pool += chars.upper;
        if (options.lower) pool += chars.lower;
        if (options.numbers) pool += chars.numbers;
        if (options.symbols) pool += chars.symbols;
        if (options.spaces) pool += chars.space.repeat(5);

        if (pool === "") {
            elements.display.value = "Select Option";
            return;
        }

        let password = "";
        for (let i = 0; i < length; i++) {
            password += pool.charAt(Math.floor(Math.random() * pool.length));
        }

        elements.display.value = password;
        updateStrength(length, options);
    }

    // strenghtpart
   function updateStrength(len, opt) {
        if (!elements.indicator) return;
        
        
        const checkedCount = Object.values(opt).filter(Boolean).length;
        
        let strength = "";
        let color = "";

        
        if (len < 8 || checkedCount < 2) {
           
            strength = 'Weak';
            color = '#f56565'; 
        } 
        else if (len >= 10 && checkedCount >= 3) {
            
            strength = 'Very Strong';
            color = '#38a169'; 
        }
        else if (len >= 12 && checkedCount >= 4) {
           
            strength = 'Very Strong';
            color = '#38a169'; 
        }
        else if (len >= 8 && checkedCount >= 3) {
         
            strength = 'Good';
            color = '#f6e05e'; 
        }
        else if (len >= 8 && checkedCount >= 2) {
           
            strength = 'Fair';
            color = '#ed8936';
        }
        else {
            strength = 'Weak';
            color = '#f56565';
        }

        elements.indicator.textContent = strength;
        elements.indicator.style.backgroundColor = color;
    }

   
    if (elements.slider) {
        elements.slider.addEventListener('input', () => {
            elements.lengthLabel.textContent = elements.slider.value;
            generatePassword();
        });
    }

   
    elements.decrement?.addEventListener('click', () => { elements.slider.value--; generatePassword(); elements.lengthLabel.textContent = elements.slider.value; });
    elements.increment?.addEventListener('click', () => { elements.slider.value++; generatePassword(); elements.lengthLabel.textContent = elements.slider.value; });

   
    document.querySelectorAll('.checkboxes input').forEach(cb => cb.addEventListener('change', generatePassword));

    
    elements.copyBtn?.addEventListener('click', () => {
        elements.display.select();
        navigator.clipboard.writeText(elements.display.value);
        elements.copyBtn.textContent = 'Copied!';
        setTimeout(() => { elements.copyBtn.textContent = 'Copy'; }, 1500);
    });

  
    generatePassword();
});