const form = document.getElementById('rentalForm');
const confirmation = document.getElementById('confirmation');

form.addEventListener('submit', function (e) {
  e.preventDefault();

  const nome = document.getElementById('nome').value.trim();
  const email = document.getElementById('email').value.trim();
  const celular = document.getElementById('celular').value.trim();
  const senha = document.getElementById('senha').value;
  const cartao = document.getElementById('cartao').value;
  const cvv = document.getElementById('cvv').value;
  const livro = document.getElementById('livro').value;
  const dias = parseInt(document.getElementById('dias').value);

  if (senha.length < 6) {
    alert("A senha deve ter no mínimo 6 caracteres.");
    return;
  }

  if (!/^\d{16}$/.test(cartao)) {
    alert("O número do cartão deve ter exatamente 16 dígitos.");
    return;
  }

  if (!/^\d{3}$/.test(cvv)) {
    alert("O CVV deve conter exatamente 3 dígitos.");
    return;
  }

  if (!/^\d{10,11}$/.test(celular)) {
    alert("Informe um número de celular válido (10 ou 11 dígitos).");
    return;
  }

  if (dias > 15 || dias < 1) {
    alert("Você pode alugar por no máximo 15 dias.");
    return;
  }

  confirmation.style.display = 'block';
  confirmation.innerHTML = `
    <strong>Aluguel confirmado!</strong><br/>
    Nome: ${nome}<br/>
    E-mail: ${email}<br/>
    Celular: ${celular}<br/>
    Livro: ${livro}<br/>
    Duração: ${dias} dia(s)<br/>
    Cartão: **** **** **** ${cartao.slice(-4)}
  `;

  form.reset();
});