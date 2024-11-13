# app.py
from flask import Flask, request, jsonify
import random

app = Flask(__name__)

# Basic rule-based response generator
def generate_response(message):
    responses = {
        "admission": "For admission inquiries, please contact the admissions office or visit our website.",
        "fees": "The school fees schedule is available on our website or can be provided by the finance office.",
        "courses": "We offer a range of courses. Please visit our course catalog for more information.",
    }
    # Find response based on keywords
    for keyword, response in responses.items():
        if keyword in message.lower():
            return response
    return "I'm here to help with school inquiries. Please be specific with your question."

@app.route('/chat', methods=['POST'])
def chat():
    user_message = request.json.get("message")
    bot_response = generate_response(user_message)
    return jsonify({"response": bot_response})

if __name__ == '__main__':
    app.run(debug=True)
