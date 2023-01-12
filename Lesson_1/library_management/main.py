# IMPORT MODULES
from tkinter import *
from PIL import ImageTk,Image
import pymysql
from tkinter import messagebox
from AddBook import *
from DeleteBook import *
from ViewBooks import *
from IssueBook import *

# DB CONNECTION

con = pymysql.connect(host='localhost',port=3306,user='root',password='',database='python_test')
cur = con.cursor()

# SETTING UP GUI
root = Tk()
root.title('My python library')
root.minsize(width=400,height=400)
root.geometry("600x500")


# Take n greater than 0.25 and less than 5
same=True
n=0.25


# BACKGROUND IMAGE
background_image =Image.open("lib_2.jpg")
[imageSizeWidth, imageSizeHeight] = background_image.size

newImageSizeWidth = int(imageSizeWidth*n)
if same:
    newImageSizeHeight = int(imageSizeHeight*n) 
else:
    newImageSizeHeight = int(imageSizeHeight/n) 
    
background_image = background_image.resize((newImageSizeWidth,newImageSizeHeight),Image.ANTIALIAS)
img = ImageTk.PhotoImage(background_image)


Canvas1 = Canvas(root)

Canvas1.create_image(300,340,image = img)      
Canvas1.config(bg="white",width = newImageSizeWidth, height = newImageSizeHeight)
Canvas1.pack(expand=True,fill=BOTH)

headingFrame1 = Frame(root,bg="#42b883",bd=5)
headingFrame1.place(relx=0.2,rely=0.1,relwidth=0.6,relheight=0.12)

headingLabel = Label(headingFrame1, text="Welcome to \n Python Library", bg='black', fg='white', font=('Courier',15))
headingLabel.place(relx=0,rely=0, relwidth=1, relheight=1)



btn1 = Button(root,text="Add Book Details",bg='#446B79', fg='white', command=addBook)
btn1.place(relx=0.28,rely=0.3, relwidth=0.45,relheight=0.1)
    
btn2 = Button(root,text="Delete Book",bg='#446B79', fg='white', command=deleteBook)
btn2.place(relx=0.28,rely=0.4, relwidth=0.45,relheight=0.1)
    
btn3 = Button(root,text="View Book List",bg='#446B79', fg='white', command=View)
btn3.place(relx=0.28,rely=0.5, relwidth=0.45,relheight=0.1)
    
btn4 = Button(root,text="Issue Book to Student",bg='#446B79', fg='white', command=issueBook)
btn4.place(relx=0.28,rely=0.6, relwidth=0.45,relheight=0.1)
    

root.mainloop()