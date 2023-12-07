import express from 'express';
import bodyParser from 'body-parser';
import cors from 'cors';
import dotenv from 'dotenv';
import { OpenAI } from "langchain/llms/openai";

dotenv.config();

const app = express();
const port = 3000;

const API_KEY = process.env.API_KEY;

const llm = new OpenAI({openAIApiKey: API_KEY,});

app.use(express.json());
app.use(cors());

app.post('/', async (req, res) => {

  let question = req.body;

  const llmResult = await llm.predict(question.question);

  res.send(llmResult)
});

// Start the server
app.listen(port, () => {
  console.log(`Server is listening at http://localhost:${port}`);
});
