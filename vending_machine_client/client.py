import serial
import time
import requests

ser = serial.Serial('/dev/ttyACM0', 9600)

time.sleep(1)

print ser.name

while(1):
    word = raw_input('> ')

    #Sends the text one character at a time
    for x in range(0, len(word)):
        ser.write(word[x])
        time.sleep(.01)

    #Request to the RESTful api to fint if the provided code exists
    r = requests.get("http://192.168.0.109:8000/api/person_in_need/pin/"+word)

    if ( "user does not exist" in r.text):
        time.sleep(5)
        ser.write("0")
    else:
        time.sleep(5)
        ser.write("1")




#Closes the connection
ser.close()
