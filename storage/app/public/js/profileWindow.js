$(function () {
    profile.init();
});

let profile = (function () {
    function _createElements() {
        $("#name").jqxInput({
            placeHolder: "Name",
            height: 30,
            width: "100%",
            minLength: 1,
            theme: "light",
        });
        $("#email").jqxInput({
            placeHolder: "Email",
            height: 30,
            width: "100%",
            minLength: 1,
            theme: "light",
        });
    }

    function _addEvent() {
        $("#editImage").on("click", () => {
            $("#inputImage").trigger("click");
        });

        $("#profile").on("click", function () {
            $("#jqxWidget").removeClass("d-none");
            $("#window").jqxWindow("open");
        });
        $(".userForm-input").on("change", function () {
            $(this).addClass("border-info border-bottom-3");
            $("#userFormBtn").removeAttr("disabled");
            $("#UpdateAlert").removeClass("d-none");
        });
        $("#inputImage").on("change", function () {
            const file = $(this).prop("files");
            if (file) {
                $("#avatar").attr("src", URL.createObjectURL(file[0]));
            }
            $("#avatar").addClass("border border-info border-4");
            $("#userFormBtn").removeAttr("disabled");
        });
    }

    function _createWindow() {
        $("#window").jqxWindow({
            position: "center",
            showCollapseButton: true,
            maxHeight: 700,
            maxWidth: 800,
            minHeight: 400,
            minWidth: 500,
            height: 500,
            width: 700,
            autoOpen: false,
            theme: "light",
            initContent: function () {
                $("#window").jqxWindow("focus");
            },
        });
    }
    return {
        config: {
            dragArea: null,
        },
        init: function () {
            _createWindow();
            _createElements();
            _addEvent();
        },
    };
})();
