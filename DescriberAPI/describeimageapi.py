import googleapi 
from fastapi import FastAPI
from pathlib import Path

app = FastAPI()


@app.get("/describe/{image}")
def describeimage(image: str)-> str:
    script_dir = Path(__file__).parent

    image_path = script_dir.parent.parent/ 'dripify' / 'public' / 'images' / image

    return googleapi.DescribeImage(f"{image_path}")



@app.get("/GenerateLook/{userid}")
def GenerateLook(userid:str ,prompt:str )-> str:
    
    return googleapi.GenerateLooks(userid, prompt)