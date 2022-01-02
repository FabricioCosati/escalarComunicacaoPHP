function addTable(trName) {
    const tbody = document.getElementById(`${trName}-body`);
    const tableRows = document.getElementsByClassName(`${trName}`);

    const newTableRow = tableRows[tableRows.length - 1].cloneNode(true);

    if (formatTable(newTableRow)) return;

    newTableRow.id = `${trName}-${tableRows.length + 1}`;

    tbody.appendChild(newTableRow);
}

function formatTable(table) {
    table.getElementsByTagName("span")[0].textContent = "0,00";

    const inputs = table.getElementsByTagName("input").length;

    for (let index = 0; index < inputs; index++) {
        if (
            table.getElementsByTagName("input")[index].value == "" &&
            table.getElementsByTagName("input")[index].type != "hidden"
        ) {
            return true;
        }

        table.getElementsByTagName("input")[index].value = "";
    }

    return false;
}

function removeTable(event) {
    const tableRow = event.target.parentElement.parentElement;

    tableRow.remove();
}

function add2decimals(e) {
    setTimeout(function () {
        let value = e.target.value;

        value = value.replace(/[^0-9-]/g, "").replace(/(?!^)-/g, "");
        value = Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        })
            .format(value / 100)
            .replace("R$", "");

        console.log(value);
        e.target.value = value;
    }, 1);
}
