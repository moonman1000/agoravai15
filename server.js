const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const path = require('path');
const fs = require('fs');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

// Servir arquivos estáticos da pasta 'public'
app.use(express.static(path.join(__dirname, 'public')));

// Rota específica para rastrearpedido.html
app.get('/rastrearpedido.html', (req, res) => {
    const filePath = path.join(__dirname, 'public', 'rastrearpedido.html');
    fs.access(filePath, fs.constants.F_OK, (err) => {
        if (err) {
            console.error(`Arquivo não encontrado: ${filePath}`);
            res.status(404).send('Página não encontrada');
        } else {
            res.sendFile(filePath);
        }
    });
});

// Rota específica para motorista.html
app.get('/motorista.html', (req, res) => {
    const filePath = path.join(__dirname, 'public', 'motorista.html');
    fs.access(filePath, fs.constants.F_OK, (err) => {
        if (err) {
            console.error(`Arquivo não encontrado: ${filePath}`);
            res.status(404).send('Página não encontrada');
        } else {
            res.sendFile(filePath);
        }
    });
});

// Rota para a página inicial
app.get('/', (req, res) => {
    res.redirect('/rastrearpedido.html');
});

// Tratamento de erro para rotas não encontradas
app.use((req, res, next) => {
    res.status(404).send('Página não encontrada');
});

// Armazenar a última localização conhecida do motorista
let lastKnownLocation = null;

io.on('connection', (socket) => {
    console.log('Novo cliente conectado');

    // Se houver uma localização conhecida, envie-a imediatamente para o novo cliente
    if (lastKnownLocation) {
        socket.emit('atualizacaoLocalizacao', lastKnownLocation);
    }

    // Quando receber uma atualização de localização do motorista
    socket.on('atualizarLocalizacao', (data) => {
        console.log('Localização atualizada:', data);
        lastKnownLocation = data;
        // Transmitir a nova localização para todos os clientes, exceto o emissor
        socket.broadcast.emit('atualizacaoLocalizacao', data);
    });

    socket.on('disconnect', () => {
        console.log('Cliente desconectado');
    });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});