// Variáveis globais
let nav = 0;
let clicked = null;
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

// Variáveis do modal
const newEvent = document.getElementById('newEventModal');
const deleteEventModal = document.getElementById('deleteEventModal');
const backDrop = document.getElementById('modalBackDrop');
const eventTitleInput = document.getElementById('eventTitleInput');

// Elementos do calendário
const calendar = document.getElementById('calendar'); // Div do calendário
const weekdays = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado']; // Array com os dias da semana

// Função para abrir o modal com eventos
function openModal(date) {
  clicked = date;
  const eventDay = events.find(event => event.date === clicked);

  if (eventDay) {
    document.getElementById('eventText').innerText = eventDay.title;
    deleteEventModal.style.display = 'block';
  } else {
    newEvent.style.display = 'block';
  }

  backDrop.style.display = 'block';
}

// Função para carregar o calendário
function load() {
  const date = new Date();

  // Alterar o título do mês
  if (nav !== 0) {
    date.setMonth(new Date().getMonth() + nav);
  }

  const day = date.getDate();
  const month = date.getMonth();
  const year = date.getFullYear();

  const daysMonth = new Date(year, month + 1, 0).getDate();
  const firstDayMonth = new Date(year, month, 1);
  const firstDayWeekdayIndex = firstDayMonth.getDay(); // Índice numérico do primeiro dia da semana (0 - Domingo, 1 - Segunda-feira, ...)

  // Mostrar mês e ano
  document.getElementById('monthDisplay').innerText = `${date.toLocaleDateString('pt-br', { month: 'long' })}, ${year}`;

  calendar.innerHTML = '';

  // Criando os dias do calendário
  for (let i = 0; i < firstDayWeekdayIndex + daysMonth; i++) {
    const dayS = document.createElement('div');
    dayS.classList.add('day');

    if (i >= firstDayWeekdayIndex) {
      const dayNumber = i - firstDayWeekdayIndex + 1;
      dayS.innerText = dayNumber;

      const dayString = `${year}-${month + 1}-${dayNumber.toString().padStart(2, '0')}`;

      // Verificar se há eventos para este dia
      const eventDay = events.find(event => event.date === dayString);
      if (eventDay) {
        const eventDiv = document.createElement('div');
        eventDiv.classList.add('event');
        eventDiv.innerText = eventDay.title;
        dayS.appendChild(eventDiv);
      }

      // Destacar o dia atual
      if (dayNumber === day && nav === 0) {
        dayS.id = 'currentDay';
      }

      // Adicionar evento de clique para abrir o modal
      dayS.addEventListener('click', () => openModal(dayString));
    } else {
      dayS.classList.add('padding');
    }

    calendar.appendChild(dayS);
  }
}

// Função para fechar o modal
function closeModal() {
  eventTitleInput.classList.remove('error');
  newEvent.style.display = 'none';
  backDrop.style.display = 'none';
  deleteEventModal.style.display = 'none';

  eventTitleInput.value = '';
  clicked = null;
  load();
}

// Função para salvar um evento
function saveEvent() {
  if (eventTitleInput.value) {
    eventTitleInput.classList.remove('error');

    events.push({
      date: clicked,
      title: eventTitleInput.value
    });

    localStorage.setItem('events', JSON.stringify(events));
    closeModal();
  } else {
    eventTitleInput.classList.add('error');
  }
}

// Função para deletar um evento
function deleteEvent() {
  events = events.filter(event => event.date !== clicked);
  localStorage.setItem('events', JSON.stringify(events));
  closeModal();
}

// Configuração dos botões e inicialização
function setupButtons() {
  document.getElementById('backButton').addEventListener('click', () => {
    nav--;
    load();
  });

  document.getElementById('nextButton').addEventListener('click', () => {
    nav++;
    load();
  });

  document.getElementById('saveButton').addEventListener('click', saveEvent);
  document.getElementById('cancelButton').addEventListener('click', closeModal);
  document.getElementById('deleteButton').addEventListener('click', deleteEvent);
  document.getElementById('closeButton').addEventListener('click', closeModal);
}

// Iniciar o calendário e configurar os botões
setupButtons();
load();
