from __future__ import unicode_literals
from django.utils.timezone import now
from django.db import models
from datetime import datetime
# Create your models here.


class Email(models.Model):
    email = models.EmailField(unique=True)
    createdAt = models.DateTimeField(default=now, blank=True)
    acceptedEmails = models.IntegerField(default=0)
    firstName = models.CharField(max_length=50)
    lastName = models.CharField(max_length=50)

    def __str__(self):
    	return self.email


class Referal(models.Model):
    email = models.EmailField(unique=True)
    createdAt = models.DateTimeField(default=now, blank=True)
    refree = models.ForeignKey(Email)
    accepted = models.BooleanField(default=False)

    def __str__(self):
    	return self.email
