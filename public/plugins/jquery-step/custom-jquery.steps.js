$("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'pill wizard',
    labels: {
        current: "En cours:",
        pagination: "Pagination",
        finish: "Terminer",
        next: "Suivant",
        previous: "Précédent",
        loading: "Chargement ..."
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        return $("#form-amm-amc").valid();
    },
    onFinishing: function (event, currentIndex) {
        return $("#form-amm-amc").valid();
    },
    onFinished: function (event, currentIndex, newIndex) {
        if (confirm("Voule vous envoyer votre demande d'autorisation ?")) {
            $("#form-amm-amc").submit();
        }
    }
});

$("#example-show").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'pill wizard',
    labels: {
        current: "En cours:",
        pagination: "Pagination",
        finish: "Terminer",
        next: "Suivant",
        previous: "Précédent",
        loading: "Chargement ..."
    },
    onFinished: function (event, currentIndex, newIndex) {
        if (confirm("Revenir à la liste des demandes ?")) {
            event.preventDefault();
            history.back(1);
        }
    }
});
