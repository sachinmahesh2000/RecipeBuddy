const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Middleware
app.use(bodyParser.json());

// Connect to MongoDB
mongoose.connect('mongodb://localhost:27017/mydatabase', { useNewUrlParser: true, useUnifiedTopology: true });

const db = mongoose.connection;
db.on('error', console.error.bind(console, 'connection error:'));
db.once('open', () => {
    console.log('Connected to MongoDB');
});

// Define a simple route
app.get('/', (req, res) => {
    res.send('Hello World!');
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});

const Item = require('./model');

// Create an item
app.post('/items', (req, res) => {
    const newItem = new Item(req.body);
    newItem.save((err, item) => {
        if (err) return res.status(500).send(err);
        return res.status(200).send(item);
    });
});

// Read all items
app.get('/items', (req, res) => {
    Item.find({}, (err, items) => {
        if (err) return res.status(500).send(err);
        return res.status(200).send(items);
    });
});

// Update an item
app.put('/items/:id', (req, res) => {
    Item.findByIdAndUpdate(req.params.id, req.body, { new: true }, (err, item) => {
        if (err) return res.status(500).send(err);
        return res.status(200).send(item);
    });
});

// Delete an item
app.delete('/items/:id', (req, res) => {
    Item.findByIdAndRemove(req.params.id, (err) => {
        if (err) return res.status(500).send(err);
        return res.status(200).send('Item deleted');
    });
});
