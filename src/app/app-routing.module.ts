import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { HomeComponent } from './pages/home/home.component';
import { TiendaComponent } from './pages/tienda/tienda.component';
import { ContactoComponent } from './pages/contacto/contacto.component';
import { CarritoComponent } from './pages/carrito/carrito.component';
import { DetalleProductoComponent } from './pages/detalle-producto/detalle-producto.component';
import { PagoComponent } from './pages/pago/pago.component';
import { ConfirmacionComponent } from './pages/confirmacion/confirmacion.component';
import { RegistroComponent } from './pages/registro/registro.component';
import { LoginComponent } from './pages/login/login.component';
import { ContactoConfirmacionComponent } from './pages/contacto-confirmacion/contacto-confirmacion.component';
import { FutbolComponent } from './pages/futbol/futbol.component';
import { PersonalizacionComponent } from './pages/personalizacion/personalizacion.component';
import { VideosComponent } from './pages/videos/videos.component';
import { FutbolistasHistoricosComponent } from './pages/futbolistas-historicos/futbolistas-historicos.component';
import { FutbolistaDetalleComponent } from './pages/futbolista-detalle/futbolista-detalle.component';
import { DetalleVideoComponent } from './pages/detalle-video/detalle-video.component';
import { CalendarioEventosComponent } from './pages/calendario-eventos/calendario-eventos.component';
import { PerfilComponent } from './pages/perfil/perfil.component';
import { OpinionesComponent } from './pages/opiniones/opiniones.component';
import { UnityGameComponent } from './pages/unity-game/unity-game.component';
import { AdminDashboardComponent } from './pages/admin/admin-dashboard/admin-dashboard.component';
import { UsuariosComponent } from './pages/admin/usuarios/usuarios.component';
import { ProductosComponent } from './pages/admin/productos/productos.component';
import { PoliticaPrivacidadComponent } from './/politica-privacidad/politica-privacidad.component';

const routes: Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  { path: 'tienda', component: TiendaComponent },
  { path: 'producto/:id', component: DetalleProductoComponent },
  { path: 'contacto', component: ContactoComponent },
  { path: 'contacto-confirmacion', component: ContactoConfirmacionComponent },
  { path: 'carrito', component: CarritoComponent },
  { path: 'pago', component: PagoComponent },
  { path: 'confirmacion', component: ConfirmacionComponent },
  { path: 'registro', component: RegistroComponent },
  { path: 'login', component: LoginComponent },
  { path: 'personalizar', component: PersonalizacionComponent },
  { path: 'personalizacion', component: PersonalizacionComponent },
  { path: 'futbol', component: FutbolComponent },
  { path: 'videos', component: VideosComponent },
  { path: 'futbolistas', component: FutbolistasHistoricosComponent },
  { path: 'futbolista/:id', component: FutbolistaDetalleComponent },
  { path: 'videos/:id', component: DetalleVideoComponent },
  { path: 'eventos', component: CalendarioEventosComponent },
  { path: 'perfil', component: PerfilComponent },
  { path: 'opiniones', component: OpinionesComponent },
  { path: 'politica-privacidad', component: PoliticaPrivacidadComponent },
  { path: 'juego', component: UnityGameComponent },

  {
    path: 'admin',
    component: AdminDashboardComponent,
    children: [
      { path: 'usuarios', component: UsuariosComponent },
      { path: 'productos', component: ProductosComponent }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
