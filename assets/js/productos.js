document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("formProducto");
  const tabla = document.querySelector("#tablaProductos tbody");
  let productos = [];
  let editando = false;
  let editIndex = null;

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const nombre = document.getElementById("nombreProducto").value;
    const cantidad = document.getElementById("cantidadProducto").value;
    const vencimiento = document.getElementById("vencimientoProducto").value;

    if (editando) {
      productos[editIndex] = { nombre, cantidad, vencimiento };
      editando = false;
      editIndex = null;
    } else {
      productos.push({ nombre, cantidad, vencimiento });
    }

    form.reset();
    renderTabla();
  });

  function renderTabla() {
    tabla.innerHTML = "";
    productos.forEach((p, i) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${p.nombre}</td>
        <td>${p.cantidad}</td>
        <td>${p.vencimiento}</td>
        <td>
          <button class="btn btn-sm btn-warning me-1" onclick="editar(${i})">Editar</button>
          <button class="btn btn-sm btn-danger" onclick="eliminar(${i})">Eliminar</button>
        </td>
      `;
      tabla.appendChild(row);
    });
  }

  window.editar = function (i) {
    const p = productos[i];
    document.getElementById("nombreProducto").value = p.nombre;
    document.getElementById("cantidadProducto").value = p.cantidad;
    document.getElementById("vencimientoProducto").value = p.vencimiento;
    editando = true;
    editIndex = i;
  };

  window.eliminar = function (i) {
    productos.splice(i, 1);
    renderTabla();
  };
});
