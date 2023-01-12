from  tkinter import *
from gtts import gTTS
from playsound import playsound

# Initialize UI

root = Tk()
root.title("TEXT TO SPEECH")
root.geometry("500x500")
root.resizable(0, 0)
root.config(bg="ghost white")

##heading
Label(root, text = 'TEXT_TO_SPEECH' , font='arial 20 bold' , bg ='white smoke').pack()
Label(root, text ='Santos Dave' , font ='arial 15 bold', bg = 'white smoke').pack(side = BOTTOM)
Msg =StringVar()
# Input
Label(root, text="Enter the Message to translate", font ='arial 12 bold', bg ='white smoke').place(relx=0.3, rely=0.1)
message_field = Entry(root, textvariable=Msg)
message_field.place(relx=0.1, rely=0.2, relwidth=0.8, relheight=0.3)

#Convertion Functions
def Convert():
    Message = message_field.get()
    speech = gTTS(text = Message)
    speech.save('convertedMessage.mp3')
    playsound('convertedMessage.mp3')
    Msg.set("Done Converting")

def Exit():
     root.destroy()

def Reset():
    Msg.set("")

# Buttons

Button(root, text="Translate", font='arial 11 bold', bg="#446B79", command=Convert).place(relx=0.1, rely=0.6, relwidth=0.2, relheight=0.1)
Button(root, text="Exit", font='arial 11 bold', bg="#446B79", command=Exit).place(relx=0.4, rely=0.6, relwidth=0.2, relheight=0.1)
Button(root, text="Reset", font='arial 11 bold', bg="#446B79", command=Reset).place(relx=0.7, rely=0.6, relwidth=0.2, relheight=0.1)



root.mainloop()
