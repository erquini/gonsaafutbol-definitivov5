import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CarritoService } from '../../services/carrito.service';
import { UsuarioService } from '../../services/usuario.service';
import { Producto } from '../../interfaces/producto';
import { OpinionesService } from '../../services/opiniones.service';


interface Recomendacion {
  nombre: string;
  descripcion: string;
  imagen: string;
  precio: number;
}

interface Testimonio {
  nombre: string;
  mensaje: string;
  fecha: string;
}

@Component({
  selector: 'app-carrito',
  templateUrl: './carrito.component.html',
  styleUrls: ['./carrito.component.css'],
  standalone: false
})
export class CarritoComponent implements OnInit {
  carrito: Producto[] = [];
  total: number = 0;

  productosRecomendados = [
    {
      id: 15,
      nombre: 'Camiseta Edición Limitada',
      precio: 39.99,
      imagen: 'assets/images/recomendacion1.jpg'
    },
    {
      id: 16,
      nombre: 'Camiseta Retro 90s',
      precio: 29.99,
      imagen: 'assets/images/recomendacion2.jpg'
    },
    {
      id: 17,
      nombre: 'Pack 3 Camisetas Personalizadas',
      precio: 59.99,
      imagen: 'assets/images/recomendacion3.jpg'
    }
  ];

opiniones: any[] = [];


  testimonios: Testimonio[] = [
    {
      nombre: 'Carlos M.',
      mensaje: 'La calidad de la camiseta es excelente y llegó en solo 2 días.',
      fecha: '10 de abril de 2025'
    },
    {
      nombre: 'Lucía G.',
      mensaje: 'Me encantó poder personalizar todo, ¡hasta el parche!',
      fecha: '3 de abril de 2025'
    },
    {
      nombre: 'Pedro R.',
      mensaje: 'Buen servicio y muy atentos en el soporte postventa.',
      fecha: '28 de marzo de 2025'
    }
  ];

constructor(
  private carritoService: CarritoService,
  private router: Router,
  private usuarioService: UsuarioService,
  private opinionesService: OpinionesService
) {}


ngOnInit(): void {
  this.carrito = this.carritoService.getCarrito(); 
  this.calcularTotal(); 

  this.opinionesService.getOpiniones().subscribe((res: any) => {
    const todas = res.opiniones;
    this.opiniones = this.obtenerAleatorias(todas, 3);
  });
}

obtenerAleatorias(lista: any[], cantidad: number): any[] {
  const mezcladas = [...lista].sort(() => 0.5 - Math.random());
  return mezcladas.slice(0, cantidad);
}


  calcularTotal(): void {
    this.total = this.carrito.reduce((acc, producto) => acc + producto.precio, 0);
  }

  eliminarProducto(index: number): void {
    this.carritoService.eliminarProducto(index);
    this.carrito = this.carritoService.getCarrito();
    this.calcularTotal();
  }

  vaciarCarrito(): void {
    this.carritoService.vaciarCarrito();
    this.carrito = [];
    this.total = 0;
  }

  procederAlPago(): void {
    if (this.carrito.length === 0) {
      alert('⚠️ Tu carrito está vacío. Agrega productos antes de proceder al pago.');
      return;
    }

    const usuarioActual = this.usuarioService['usuarioSubject'].value;

    if (usuarioActual) {
      this.router.navigate(['/pago']);
    } else {
      alert('🔒 Debes iniciar sesión para continuar con el pago.');
      this.router.navigate(['/login']);
    }
  }

  seguirComprando(): void {
    this.router.navigate(['/tienda']);
  }
    getRutaImagen(imagen: string): string {
  if (imagen.startsWith('uploads/')) {
    return 'http://localhost/gonsa-futbol-api/' + imagen;
  }
  return imagen; // ya es assets/...
}
}
