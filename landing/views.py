from django.shortcuts import render
from models import *
from serializers import *
from rest_framework import viewsets
from rest_framework import mixins
import requests
import json

API_KEY = 'fd0e5be65d294987f46c72f8b9e82cff-us13'
LIST_ID = 'ba390f4771'
REFERAL_ID = 'b1760dcc95'
MAILCHIMP_URL = "https://us13.api.mailchimp.com/3.0/"
SUBSCRIBE_LIST = MAILCHIMP_URL + "lists/" + LIST_ID + "/members"
SUBSCRIBE_REFERAL = MAILCHIMP_URL + "lists/" + REFERAL_ID + "/members"

# Create your views here.

# def referMailChimp(request):
#     data = {
#         "status": "subscribed",
#         "email_address": request.POST['email'],
#         "merge_fields": {
#             "First Name": request.POST['First Name'],
#             "Last Name": request.POST['Last Name']
#         }
#     }
#     r = requests.post(SUBSCRIBE_LIST, data)
#     return JsonResponse(r.json())


def subscribeToMailChimp(emailInstance):
    firstName = emailInstance.firstName
    lastName = emailInstance.lastName
    email = emailInstance.email
    data = {
        "status": "pending",
        "email_address": email,
        "merge_fields": {
            "FNAME": firstName,
            "LNAME": lastName
        }
    }
    headers = {
        'Authorization': 'apikey ' + API_KEY
    }
    r = requests.post(SUBSCRIBE_LIST, data=json.dumps(data), headers=headers)


def referMailChimp(referalInstance):
    refree = referalInstance.refree
    firstName = refree.firstName
    lastName = refree.lastName
    email = referalInstance.email
    data = {
        "status": "subscribed",
        "email_address": email,
        "merge_fields": {
            "REF": "%s %s" % (firstName, lastName),

        }
    }
    print(data)
    headers = {
        'Authorization': 'apikey ' + API_KEY
    }
    r = requests.post(SUBSCRIBE_REFERAL, data=json.dumps(data), headers=headers)
    print(r.json())

class EmailViewSet(mixins.CreateModelMixin,
                mixins.ListModelMixin,
                mixins.RetrieveModelMixin,
                viewsets.GenericViewSet):
        queryset = Email.objects.all()
        serializer_class = EmailSerializer

        def perform_create(self, serializer):
            instance = serializer.save()            
            subscribeToMailChimp(instance)
            email = instance.email
            refrees = Referal.objects.filter(email=email)
            for r in refrees:
                refree = r.refree
                refree.acceptedEmails += 1
                r.accepted = True
                refree.save()
                r.save()
                # send email to r.refree

class ReferalViewSet(mixins.CreateModelMixin,
                mixins.ListModelMixin,
                mixins.RetrieveModelMixin,
                viewsets.GenericViewSet):
        queryset = Referal.objects.all()
        serializer_class = ReferalSerializer

        def perform_create(self, serializer):
            instance = serializer.save()
            referMailChimp(instance)
