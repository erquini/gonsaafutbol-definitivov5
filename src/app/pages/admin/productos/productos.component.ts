import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Producto } from '../../../interfaces/producto';

@Component({
  selector: 'app-productos',
  templateUrl: './productos.component.html',
  styleUrls: ['./productos.component.css'],
  standalone: false
})
export class ProductosComponent implements OnInit {
  productos: Producto[] = [];
  productoEditando: Producto | null = null;

  // Modelo para nuevo producto
  nuevoProducto: any = {
    nombre: '',
    descripcion: '',
    precio: 0,
    stock: 0,
    categoria: ''
  };
  imagenSeleccionada!: File;

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.cargarProductos();
  }

  // Obtener productos
  cargarProductos() {
    this.http.get<Producto[]>('http://localhost/gonsa-futbol-api/obtener_productos.php')
      .subscribe(data => {
        this.productos = data;
      });
  }

  // Eliminar producto
  eliminar(id: number) {
    if (confirm('¿Eliminar producto permanentemente?')) {
      this.http.delete(`http://localhost/gonsa-futbol-api/eliminar_producto.php?id=${id}`)
        .subscribe(() => {
          this.productos = this.productos.filter(p => p.id !== id);
        });
    }
  }

  // Editar producto
  editar(p: Producto) {
    this.productoEditando = { ...p };
  }

  // Guardar cambios de edición
  guardarCambios() {
    if (this.productoEditando) {
      this.http.post('http://localhost/gonsa-futbol-api/editar_producto.php', this.productoEditando)
        .subscribe(() => {
          this.cargarProductos();
          this.productoEditando = null;
        });
    }
  }

  // Cancelar edición
  cancelarEdicion() {
    this.productoEditando = null;
  }

  // Manejar archivo seleccionado
  onFileSelected(event: any) {
    this.imagenSeleccionada = event.target.files[0];
  }

  // Crear nuevo producto
 crearProducto() {
  const formData = new FormData();
  formData.append('nombre', this.nuevoProducto.nombre);
  formData.append('descripcion', this.nuevoProducto.descripcion);
  formData.append('precio', this.nuevoProducto.precio.toString());
  formData.append('stock', this.nuevoProducto.stock.toString());
  formData.append('categoria', this.nuevoProducto.categoria);
  formData.append('imagen', this.imagenSeleccionada);

  this.http.post<any>('http://localhost/gonsa-futbol-api/crear_producto.php', formData)
    .subscribe({
      next: (res) => {
        console.log('✔ Producto creado:', res);

        if (res.status === 'ok') {
          alert('✅ Producto agregado correctamente');
          this.cargarProductos();
          this.nuevoProducto = {
            nombre: '',
            descripcion: '',
            precio: 0,
            stock: 0,
            categoria: ''
          };
        } else {
          alert('⚠️ Error: ' + res.mensaje);
        }
      },
      error: (err) => {
        console.error('❌ Error HTTP al crear producto:', err);
        alert('❌ Error al crear producto. Revisa la consola.');
      }
    });
}


  // Obtener ruta de imagen
  getRutaImagen(ruta: string): string {
    if (ruta.startsWith('uploads/')) {
      return 'http://localhost/gonsa-futbol-api/' + ruta;
    } else {
      return ruta; // ya es 'assets/...'
    }
  }
}
