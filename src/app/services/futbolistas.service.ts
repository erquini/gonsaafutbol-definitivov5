import { Injectable } from '@angular/core';

export interface Futbolista {
  id: number;
  nombre: string;
  pais: string;
  descripcion: string;
  biografia: string;
  trofeos: string[];
  imagen: string;
}

@Injectable({
  providedIn: 'root'
})
export class FutbolistasService {
  private futbolistas: Futbolista[] = [
    {
      id: 1,
      nombre: 'Pelé',
      pais: 'Brasil',
      descripcion: 'Considerado uno de los mejores futbolistas de todos los tiempos.',
      biografia: `Edson Arantes do Nascimento, conocido como Pelé, revolucionó el fútbol mundial con su habilidad, visión y capacidad goleadora.
Ganó tres Copas del Mundo con Brasil en 1958, 1962 y 1970, siendo el único futbolista en lograr tal hazaña.
En su club Santos FC, marcó más de 1.000 goles y llevó al equipo a ganar múltiples títulos nacionales e internacionales.
Fue un símbolo del deporte rey, respetado y querido tanto dentro como fuera del campo.
Además de sus logros deportivos, Pelé promovió el fútbol como herramienta de unión y paz en el mundo.
Su legado permanece vivo como ícono global del fútbol.`,
      trofeos: ['3 Copas del Mundo', '2 Copas Libertadores', '10 Campeonatos Paulistas'],
      imagen: 'assets/images/futbolistas/pele.jpg'
    },
    {
      id: 2,
      nombre: 'Diego Maradona',
      pais: 'Argentina',
      descripcion: 'Icono del fútbol argentino y protagonista del “Gol del Siglo”.',
      biografia: `Diego Armando Maradona fue un talento único que marcó una época dorada para Argentina y el Napoli.
Lideró a la selección argentina al título mundial en 1986 con actuaciones inolvidables y goles legendarios.
Su famoso "Gol del Siglo" ante Inglaterra es considerado uno de los mejores goles en la historia del fútbol.
En el Napoli ganó títulos históricos, transformando un equipo modesto en un gigante de Italia y Europa.
A pesar de las polémicas fuera del campo, su impacto futbolístico es indiscutible e inspiró a generaciones.
Maradona es recordado como un genio impredecible, apasionado y profundamente humano.`,
      trofeos: ['1 Copa del Mundo', '2 Serie A', '1 UEFA Cup'],
      imagen: 'assets/images/futbolistas/maradona.jpg'
    },
    {
      id: 3,
      nombre: 'Zinedine Zidane',
      pais: 'Francia',
      descripcion: 'Mediocampista elegante y cerebral, ícono del fútbol francés.',
      biografia: `Zinedine Zidane fue una estrella mundial, famoso por su técnica, clase y visión en el campo.
Ganó la Copa del Mundo de 1998 con Francia anotando dos goles en la final contra Brasil.
También fue campeón de la Eurocopa 2000 y brilló en clubes como Juventus y Real Madrid.
Su gol de volea en la final de la Champions League 2002 es una de las imágenes icónicas del torneo.
Como entrenador, ganó tres Champions consecutivas con el Real Madrid, algo nunca visto en la era moderna.
Su liderazgo y elegancia lo han convertido en un símbolo de respeto en el mundo del fútbol.`,
      trofeos: ['1 Copa del Mundo', '1 Eurocopa', '1 Champions League'],
      imagen: 'assets/images/futbolistas/zidane.jpg'
    },
    {
      id: 4,
      nombre: 'Johan Cruyff',
      pais: 'Países Bajos',
      descripcion: 'Pionero del “fútbol total” y referente táctico y técnico.',
      biografia: `Johan Cruyff fue el cerebro del famoso “fútbol total” de la selección neerlandesa en los años 70.
Como jugador del Ajax y Barcelona, ganó múltiples títulos y revolucionó la forma de entender el juego.
Sus movimientos, visión y capacidad de asociación eran simplemente brillantes.
No solo fue un gran jugador, también como técnico cambió el destino del FC Barcelona para siempre.
Introdujo la filosofía de cantera y juego ofensivo que sentó las bases del Barça moderno.
Su influencia va más allá del campo: es una figura intelectual del fútbol.`,
      trofeos: ['3 Copas de Europa', '8 Eredivisie', '1 Balón de Oro'],
      imagen: 'assets/images/futbolistas/cruyff.jpg'
    },
    {
      id: 5,
      nombre: 'Lionel Messi',
      pais: 'Argentina',
      descripcion: 'Máximo goleador de la historia del FC Barcelona y la selección argentina.',
      biografia: `Lionel Messi es considerado por muchos como el mejor jugador de la historia del fútbol moderno.
Debutó con el FC Barcelona en 2004 y se convirtió en su máximo ídolo ganando todos los títulos posibles.
Con una zurda mágica, dribbling inigualable y visión superior, ha roto todos los récords de goles y asistencias.
Ganó 7 Balones de Oro, 10 Ligas, 4 Champions y recientemente la Copa América 2021 con Argentina.
Más allá de los títulos, Messi representa la humildad y excelencia dentro del deporte.
Actualmente sigue deleitando al mundo con su fútbol, ahora en el Inter de Miami.`,
      trofeos: ['1 Copa América', '4 Champions League', '7 Balones de Oro'],
      imagen: 'assets/images/futbolistas/messi.jpg'
    },
    {
      id: 6,
      nombre: 'Cristiano Ronaldo',
      pais: 'Portugal',
      descripcion: 'Atleta imparable, goleador nato y líder indiscutido.',
      biografia: `Cristiano Ronaldo ha sido una fuerza dominante en el fútbol europeo por más de una década.
Con paso por el Manchester United, Real Madrid, Juventus y ahora Al-Nassr, ha dejado huella en cada club.
Ganó múltiples Champions, Ligas y Balones de Oro destacándose por su profesionalismo y ambición.
Con Portugal ganó la Eurocopa 2016 y la Nations League, siendo líder absoluto.
Su mentalidad de trabajo, condición física y capacidad goleadora lo hacen una máquina competitiva.
Fuera del campo es una figura global y ejemplo de superación para millones.`,
      trofeos: ['5 Champions League', '1 Eurocopa', '5 Balones de Oro'],
      imagen: 'assets/images/futbolistas/cr7.jpg'
    },
    {
      id: 7,
      nombre: 'Ronaldinho',
      pais: 'Brasil',
      descripcion: 'La sonrisa del fútbol, artista del balón.',
      biografia: `Ronaldinho fue magia pura en los pies, su alegría contagió al mundo del fútbol.
Brilló en clubes como PSG, Barcelona y Milan, donde regaló goles, asistencias y regates irrepetibles.
Ganó el Balón de Oro en 2005 y la Champions League en 2006 con el Barça.
Con Brasil fue campeón del mundo en 2002, siendo parte clave del ataque.
Era impredecible, talentoso y con una conexión natural con el balón que lo hacía único.
Aún hoy es recordado con cariño por todos los aficionados al fútbol por su carisma y estilo.`,
      trofeos: ['1 Copa del Mundo', '1 Champions League', '1 Balón de Oro'],
      imagen: 'assets/images/futbolistas/ronaldinho.jpg'
    },
    {
      id: 8,
      nombre: 'Franz Beckenbauer',
      pais: 'Alemania',
      descripcion: 'El “Kaiser”, creador del rol de líbero moderno.',
      biografia: `Beckenbauer fue un defensor elegante y cerebral que cambió el rol de los zagueros.
Inventó la figura del líbero, dirigiendo el juego desde la defensa con visión y clase.
Lideró a Alemania a ganar la Copa Mundial de 1974 y como técnico la del 1990.
Con el Bayern ganó múltiples Bundesligas y tres Copas de Europa consecutivas.
Fue respetado por su inteligencia táctica y liderazgo tanto en el campo como desde el banquillo.
Su legado como jugador y entrenador lo convierten en uno de los más completos de la historia.`,
      trofeos: ['2 Copas del Mundo (jugador/entrenador)', '3 Copas de Europa', '5 Bundesligas'],
      imagen: 'assets/images/futbolistas/beckenbauer.jpg'
    },
    {
      id: 9,
      nombre: 'Roberto Baggio',
      pais: 'Italia',
      descripcion: 'El “Divino Codino”, símbolo de técnica y clase.',
      biografia: `Roberto Baggio fue uno de los jugadores más elegantes y queridos de Italia.
Jugó en los grandes clubes italianos y brilló en los Mundiales de 1990 y 1994.
Su técnica depurada, visión de juego y precisión en los tiros libres eran admirables.
Aunque su penal fallado en la final del 94 marcó su historia, su legado va más allá.
Fue un jugador humilde, con gran carácter y compromiso con su selección.
En Italia es un mito que representa la belleza y el dolor del fútbol al mismo tiempo.`,
      trofeos: ['1 Balón de Oro', '2 Copas Italia', '1 Serie A'],
      imagen: 'assets/images/futbolistas/baggio.jpg'
    },
    {
      id: 10,
      nombre: 'Marco van Basten',
      pais: 'Países Bajos',
      descripcion: 'Delantero letal y técnico, ícono del AC Milan.',
      biografia: `Van Basten fue un delantero espectacular con una capacidad goleadora sublime.
      Ganó tres Balones de Oro y fue pieza clave del Milan de Sacchi que dominó Europa.
      Con la selección neerlandesa ganó la Eurocopa 1988 con un gol inolvidable en la final.
Su carrera se vio truncada por lesiones, pero dejó una marca imborrable.
Era potente, técnico y con una lectura del juego digna de los grandes.
Es considerado uno de los mejores delanteros de todos los tiempos.`,
      trofeos: ['3 Balones de Oro', '2 Copas de Europa', '1 Eurocopa'],
      imagen: 'assets/images/futbolistas/vanbasten.jpg'
    }
  ];

  getFutbolistas() {
    return this.futbolistas;
  }

  getFutbolistaPorId(id: number) {
    return this.futbolistas.find(f => f.id === id);
  }
}
