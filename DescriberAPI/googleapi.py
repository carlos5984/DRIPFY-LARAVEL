import mysql.connector
from google import genai
from google.genai import types
from PIL import Image
import config 
import io


PROJECT_ID = config.PROJECT_ID
LOCATION = config.LOCATION
DB_HOST=config.DB_HOST
DB_USER=config.DB_USER
DB_PASS=config.DB_PASS
DB_NAME=config.DB_NAME



def DescribeImage(path: str, max_size: tuple = (512,512)) -> str:
    client = genai.Client(vertexai=True, project=PROJECT_ID, location=LOCATION)
    
    image = Image.open(path) 
    image = image.convert("RGB")  # Ensure the image is in RGB format    
    image.thumbnail(max_size)  # Resize the image while maintaining aspect ratio
    buffer = io.BytesIO()
    image.save(buffer, format="PNG")  # Save the image to a buffer in PNG format
    image_content = buffer.getvalue()  # Get the byte content of the image
        
    image_part = types.Part(
        inline_data=types.Blob(
            mime_type="image/png",
            data=image_content
        )
)
    prompt_parts = [
        '''Return a valid JSON object with a single key-value pair.
    "<name>": { "description": "<detail>" }
    - <name> = most prominent clothing item in the image
    - <detail> = detailed description of it
    - Use proper double quotes for JSON keys and values
    - Do not add extra text
    - Enclose the whole output in curly braces { }'''
    ,
    image_part
    ]
    
    config=types.GenerateContentConfig(
        temperature=0.8,
        top_p=0.95, 
        top_k=20,
        candidate_count=1,
        seed=5,
        max_output_tokens=256,
        stop_sequences=["STOP!"],
        presence_penalty=0.0,
        frequency_penalty=0.0,
        safety_settings=[
            types.SafetySetting(
                category=types.HarmCategory.HARM_CATEGORY_HATE_SPEECH,
                threshold=types.HarmBlockThreshold.BLOCK_ONLY_HIGH,
            )
        ],
    )
    response = client.models.generate_content(
    model="gemini-2.5-flash-lite",
    contents=prompt_parts,
    config=config,
    ).text 
    
    print(response)
    return response if response else "ERROR : API RETURNED NONE"



def GenerateLooks(userid: str, user_prompt: str) -> str:
    client = genai.Client(vertexai=True, project=PROJECT_ID, location=LOCATION)
    db =mysql.connector.connect(
    host=DB_HOST,
    user=DB_USER,
    password=DB_PASS,
    database=DB_NAME
    )
    cursor = db.cursor(dictionary=True)
    cursor.execute("SELECT id,clothing_name,clothing_description,available FROM clothing WHERE user_id = %s",[userid])
    clothing =  cursor.fetchall()

    
    prompt = [
    f'''You are a fashion stylist AI. Your task is to create ONE singular clothing look based on the user's style request and clothing inventory.

    Rules:
    1. Read the "prompt" to understand the requested style.
    2. Read the "clothing_inventory" array to find matching clothing.
    3. Each look must contain exactly one item per category:
       - tops, bottoms, footwear, accessories
    4. Identify the category of each clothing item using both `clothing_name` and `clothing_description`.
    5. Skip any category with no matching items, but include the rest.
    6. No duplicate categories in a single look.
    7. Avoid repeating the exact same item in multiple looks unless inventory is very limited.
    8. Never include items with `available = 0`. Replace unavailable items with similar ones.
    9. Output **only a single array of clothing IDs** in standard array syntax. For example: ["uuid1","uuid2","uuid3"]. Do **not** include any JSON objects, extra braces, or explanations.

    Input example:
    prompt: "I wanna go goth today"
    clothing_inventory: [
        {{
          "id": "uuid1",
          "clothing_name": "black hoodie",
          "clothing_description": "Oversized black cotton hoodie",
          "available": 1
        }},
        {{
          "id": "uuid2",
          "clothing_name": "black jeans",
          "clothing_description": "Slim fit black denim jeans",
          "available": 1
        }},
        {{
          "id": "uuid3",
          "clothing_name": "combat boots",
          "clothing_description": "Black leather lace-up combat boots",
          "available": 1
        }}
    ]

    Expected output example:
    ["uuid1","uuid2","uuid3"]

    # USER INPUT
    user_clothing: {clothing}
    user_prompt: {user_prompt}
    '''

    ]

    config=types.GenerateContentConfig(
        temperature=0.8,
        top_p=0.95,
        top_k=20,
        candidate_count=1,
        seed=5,
        max_output_tokens=2048,
        stop_sequences=["STOP!"],
        presence_penalty=0.0,
        frequency_penalty=0.0,
        safety_settings=[
            types.SafetySetting(
                category=types.HarmCategory.HARM_CATEGORY_HATE_SPEECH,
                threshold=types.HarmBlockThreshold.BLOCK_ONLY_HIGH,
            )
        ],
    )
    response = client.models.generate_content(
    model="gemini-2.5-flash-lite",
    contents=prompt, #type: ignore
    config=config,
    ).text 
    
    print(response)
    return response if response else "ERROR : API RETURNED NONE"