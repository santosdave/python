from django.db import models

# Create your models here.


# Parent Model

class forum(models.Model):
    name = models.CharField(max_length=200,default="anonymous")
    email = models.EmailField(max_length=200, null=True)
    topic = models.CharField(max_length=300)
    description = models.CharField(max_length=1000, null=True)
    link = models.CharField(max_length=100, null=True)
    date_created = models.DateTimeField(auto_now_add=True, null=True)
  

    def __str__(self):
        return str (self.topic)

# Child Model

class Discussion(models.Model):
    forum = models.ForeignKey(forum, on_delete=models.CASCADE)
    discuss = models.CharField(max_length=1000)

    def __str__(self):
            return str(self.forum)