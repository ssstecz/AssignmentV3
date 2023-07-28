let app = Vue.createApp({
  data() {
    return {
      additemsPage1: 'https://scwta.000webhostapp.com/addproduct',
      prodlistPage1: 'https://scwta.000webhostapp.com/',
      additemsPage: 'index2.php',
      prodlistPage: 'index.php',
      selected: 'none',
      sizeText: '#size',
      weightText: '#weight',
      heightText: '#height',
      widthText: '#width',
      lengthText: '#lengtht',
    };
  },
  methods: {
    getCheckedBoxes(event) {
      const checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
      const ids = [];
      for (let i = 0; i < checkboxes.length; i++) {
        ids.push(checkboxes[i].id);
      }
      console.log(ids);

      document.getElementById("del_item").value = ids;
      // Check if array with checkboxes clicked is empty
      if (ids.length === 0) {
        event.preventDefault();
        this.showModal = true;
      }
    },
    toggleMassDeleteButton() {
      const checkboxes = document.querySelectorAll(
        'input[type=checkbox]:checked'
      );
      const deleteButton = document.getElementById('delete-product-btn');
      deleteButton.disabled = checkboxes.length === 0;
    },
    sizeInfoOver() {
      this.sizeText = 'Please insert here the DVD Size in Mb. Use only numbers and . as decimal separator';
    },
    sizeInfoOut() {
      this.sizeText = '#size';
    },
    weightInfoOver() {
      this.weightText = 'Please insert here the Book Weight in kg. Use only numbers and . as decimal separator';
    },
    weightInfoOut() {
      this.weightText = '#book';
    },
    heightInfoOver() {
      this.heightText = 'Please insert here the Height in cm. Use only numbers and . as decimal separator';
    },
    heightInfoOut() {
      this.heightText = '#height';
    },
    widthInfoOver() {
      this.widthText = 'Please insert here the Width in cm. Use only numbers and . as decimal separator';
    },
    widthInfoOut() {
      this.widthText = '#width';
    },
    lengthInfoOver() {
      this.lengthText = 'Please insert here the Length in cm. Use only numbers and . as decimal separator';
    },
    lengthInfoOut() {
      this.lengthText = '#length';
    },
    handleFormSubmit() {
      const form = document.getElementById('product_form');
      const inputs = form.querySelectorAll('.form-control input');
      inputs.forEach((input) => {
        this.hideError(input);
      });
      let hasErrors = false;
      inputs.forEach((input) => {
        if (!this.validateInput(input)) {
          hasErrors = true;
        }
      });
      if (hasErrors) {
        return false;
      }
      form.submit();
    },
    validateInput(input) {
      const id = input.id;
      if (id === 'sku') {
        this.validateSku(input);
      } else if (id === 'name') {
        this.validateName(input);
      } else if (id === 'price') {
        this.validateDigit(input);
      } else if (id === 'size') {
        this.validateDigit(input);
      } else if (id === 'weight') {
        this.validateDigit(input);
      } else if (id === 'height' || id === 'width' || id === 'length') {
        this.validateDigit(input);
      }
    },
    validateSku(input) {
      // Validation logic for sku field
      const value = input.value;
      if (/^\s|\s$|\s(?!$)|(?<!^)\s|[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(value)) {
        this.showError(input, 'Please, provide the data of indicated type');
      } else if (/^$/.test(value) || (input.value === '')) {
        this.showError(input, 'Please, submit required data');
      } else {
        this.showSuccess(input);
      }
    },
    validateName(input) {
      // Validation logic for name field
      if (input.value === '') {
        this.showError(input, 'Please, submit required data');
      } else if (/^\s*$/.test(input.value) || /^[^\w\s]+$/.test(input.value)) {
        this.showError(input, 'Please, provide the data of the indicated type');
      } else {
        this.showSuccess(input);
      }
    },
    validateDigit(input) {
      // Validation logic for price field
      const value = input.value;
      if (value === '') {
        this.showError(input, 'Please, submit required data');
        return;
      }
      if ((/\s/.test(value)) ||
        (/^[a-zA-Z]/.test(value)) ||
        (/[!@#$%^&*()_+\-=\[\]{};\'\:"\\|,<>\/?]+/.test(value)) ||
        (/^\d+(\s|[a-zA-Z])/.test(value))) {
        this.showError(input, 'Please, provide the data of indicated type');
        return;
      }
      const priceValue = parseFloat(value);
      if (priceValue <= 0) {
        this.showError(input, 'Please, submit required data');
        return;
      }
      this.showSuccess(input);
    },
    showError(input, message) {
      const formControl = input.parentElement;
      formControl.className = 'form-control error';
      const small = formControl.querySelector('small');
      small.innerText = message;
    },
    hideError(input) {
      const formControl = input.parentElement;
      formControl.className = 'form-control';
      const small = formControl.querySelector('small');
      small.innerText = '';
    },
    showSuccess(input) {
      const formControl = input.parentElement;
      formControl.className = 'form-control success';
    },
  },
  mounted() {
    const form = document.getElementById('product_form');
    form.addEventListener('submit', (e) => {
      this.handleFormSubmit();
    });
  },
});