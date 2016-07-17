from rest_framework import routers
from landing.views import *

router = routers.SimpleRouter()
router.register(r'api/email', EmailViewSet)
router.register(r'api/referal', ReferalViewSet)
