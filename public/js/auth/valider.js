// Get the select element

document.addEventListener("DOMContentLoaded", function () {
    toggleFields();
    document.querySelectorAll(".view-store").forEach((button) => {
        button.addEventListener("click", function () {
            let userId = this.dataset.id;

            fetch(`/a/users/${userId}/store`)
                .then((res) => res.json())
                .then((data) => {
                    if (data.store) {
                        document.getElementById("store_name").textContent =
                            data.store.name;
                        document.getElementById("store_category").textContent =
                            data.store.category;
                        document.getElementById("store_address").textContent =
                            data.store.address;
                        document.getElementById("store_contact").textContent =
                            data.store.contact;
                        document.getElementById("store_subscription_status").textContent =
                            data.store.subscription_status;

                        // Set store ID for manual activation
                        if (document.getElementById("activation_store_id")) {
                            document.getElementById("activation_store_id").value = data.store.id;
                        }

                        var storeModal = new bootstrap.Modal(
                            document.getElementById("storeModal")
                        );
                        storeModal.show();
                    }
                });
        });

        
    });

    document.getElementById("wilaya").addEventListener("change", function () {
        let wilayaId = this.value;
        let communeSelect = document.getElementById("commune");

        // نجيب النصوص من data attributes
        let loadingText = communeSelect.dataset.loading;
        let selectText = communeSelect.dataset.select;

        communeSelect.innerHTML = `<option value="">${loadingText}</option>`;

        let locale = document.documentElement.lang; // أو نمرروها من Blade

        if (wilayaId) {
            fetch("/api/communes/" + wilayaId)
                .then((response) => response.json())
                .then((data) => {
                    communeSelect.innerHTML = `<option value="">${selectText}</option>`;
                    data.forEach((commune) => {
                        let name =
                            locale === "ar" ? commune.ar_name : commune.name;
                        communeSelect.innerHTML += `<option value="${commune.id}">${name}</option>`;
                    });
                });
        } else {
            communeSelect.innerHTML = `<option value="">${selectText}</option>`;
        }
    });

    passwordHint();
});

function passwordHint() {
    const passwordInput = document.getElementById("password");
    const tooltip = document.getElementById("passwordTooltip");

    passwordInput.addEventListener("focus", () => {
        tooltip.classList.remove("d-none");
    });

    passwordInput.addEventListener("blur", () => {
        tooltip.classList.add("d-none");
    });
}

function toggleFields() {
    const role = document.getElementById("role").value;
    const storeSection = document.getElementById("storeSection");
    const storeInputs = storeSection.querySelectorAll("input");

    if (role == "2") {
        // seller
        storeSection.style.display = "";
        storeInputs.forEach((input) => input.setAttribute("required", true));
    } else {
        storeSection.style.display = "none";
        storeInputs.forEach((input) => input.removeAttribute("required"));
    }
}
