document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("cervezaForm");
  const inputs = form.querySelectorAll("input, select");
  const sinAlergenos = document.getElementById("sinalergenos");
  const alergenos = document.querySelectorAll(
    'input[name="alergenos[]"]:not(#sinalergenos)'
  );

  // Validación en tiempo real
  inputs.forEach((input) => {
    input.addEventListener("blur", function () {
      validarCampo(input);
    });
  });

  form.addEventListener("submit", function (event) {
    let valido = true;
    inputs.forEach((input) => {
      if (!validarCampo(input)) {
        valido = false;
      }
    });
    if (!valido) {
      event.preventDefault();
    }
  });

  function validarCampo(input) {
    let errorMessage = input.nextElementSibling;
    if (!errorMessage || !errorMessage.classList.contains("error-message")) {
      return true;
    }

    if (
      (input.type === "text" || input.type === "number") &&
      input.value.trim() === ""
    ) {
      errorMessage.style.display = "inline";
      return false;
    } else if (input.tagName === "SELECT" && input.value === "") {
      errorMessage.style.display = "inline";
      return false;
    } else if (input.type === "radio") {
      let radios = document.querySelectorAll(`input[name="${input.name}"]`);
      let seleccionado = Array.from(radios).some((radio) => radio.checked);
      if (!seleccionado) {
        errorMessage.style.display = "inline";
        return false;
      }
    } else {
      errorMessage.style.display = "none";
    }
    return true;
  }

  // Checkbox de "Sin alérgenos"
  sinAlergenos.addEventListener("change", function () {
    if (this.checked) {
      alergenos.forEach((checkbox) => {
        checkbox.checked = false;
        checkbox.disabled = true;
      });
    } else {
      alergenos.forEach((checkbox) => {
        checkbox.disabled = false;
      });
    }
  });

  // Si se marca cualquier otro alérgeno, desmarcar "Sin alérgenos"
  alergenos.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      if (this.checked) {
        sinAlergenos.checked = false;
        sinAlergenos.disabled = false;
      }
    });
  });
});
